<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LoanController extends Controller
{

    public function index(Request $request)
    {
        $query = Loan::with(['user', 'items'])->latest();

        // Mahasiswa hanya boleh melihat peminjamannya sendiri
        if (! $request->user()->isAdmin()) {
            $query->where('user_id', $request->user()->id);
        }

        // Filter berdasarkan status peminjaman
        if ($request->filled('status') && in_array($request->status, ['dipinjam', 'dikembalikan'])) {
            $query->where('status', $request->status);
        }

        $semuaPeminjaman = $query->paginate(10)->withQueryString();

        return view('peminjaman.index', compact('semuaPeminjaman'));
    }

    public function create()
    {
        $alatTersedia = Item::available()->orderBy('name')->get(); // hanya alatdengan stok > 0
        return view('peminjaman.create', compact('alatTersedia'));
    }


public function store(Request $request)
{
    $validated = $request->validate([
        'items' => 'required|array',
        'items.*' => 'required|integer|min:0',
        'due_date' => 'required|date|after_or_equal:today|before_or_equal:' .
            now()->addDays(7)->toDateString(),
        'notes' => 'nullable|max:255',
    ], [
        'items.required' => 'Pilih minimal satu alat untuk dipinjam.',
        'items.*.integer' => 'Jumlah alat harus berupa angka.',
        'items.*.min' => 'Jumlah alat tidak boleh negatif.',
        'due_date.required' => 'Tanggal kembali wajib diisi.',
        'due_date.after_or_equal' => 'Tanggal kembali tidak boleh sebelum hari ini.',
        'due_date.before_or_equal' => 'Lama peminjaman maksimal 7 hari.',
    ]);

    $itemsDipinjam = collect($validated['items'])
        ->filter(fn ($qty) => $qty > 0);

    if ($itemsDipinjam->isEmpty()) {
        return back()->withInput()->withErrors([
            'items' => 'Pilih minimal satu alat dengan jumlah lebih dari 0.',
        ]);
    }

    $daftarAlat = [];

    foreach ($itemsDipinjam as $itemId => $qty) {
        $alat = Item::find($itemId);

        if (! $alat) {
            return back()->withInput()->withErrors([
                'items' => "Alat dengan ID {$itemId} tidak ditemukan.",
            ]);
        }

        if ($qty > $alat->stock) {
            return back()->withInput()->withErrors([
                'items' => "Stok {$alat->name} hanya tersisa {$alat->stock}.",
            ]);
        }

        $daftarAlat[$itemId] = $alat;
    }

    DB::transaction(function () use (
        $request,
        $validated,
        $itemsDipinjam,
        $daftarAlat
    ) {
        $peminjaman = $request->user()->loans()->create([
            'loan_date' => today(),
            'due_date' => $validated['due_date'],
            'status' => 'dipinjam',
            'notes' => $validated['notes'] ?? null,
        ]);

        foreach ($itemsDipinjam as $itemId => $qty) {
            $alat = $daftarAlat[$itemId];

            $peminjaman->items()->attach($alat->id, [
                'qty' => $qty,
            ]);

            $alat->decrement('stock', $qty);
        }
    });

    return redirect()->route('peminjaman.index')
        ->with('success', 'Peminjaman berhasil dicatat.');
}


    public function kembalikan(Loan $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Peminjaman ini sudah dikembalikan.');
        }
        DB::transaction(function () use ($peminjaman) {
            // Kembalikan stok setiap alat sesuai jumlah yang dipinjam
            foreach ($peminjaman->items as $alat) {
                $alat->increment('stock', $alat->pivot->qty);
            }
            $peminjaman->update([
                'status' => 'dikembalikan',
                'returned_at' => today(),
            ]);
        });
        return back()->with('success', 'Alat sudah dikembalikan dan stok
diperbarui.');
    }
}
