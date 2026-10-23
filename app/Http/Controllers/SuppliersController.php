<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;


class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = Suppliers::OrderBy('name')->get();
        return view('suppliers.index', compact('suppliers'));
    }
    public function create()
    {
        return view('suppliers.create');
    }
   public function store(Request $request)
{
    $validated = $request->validate([
        'name'   => 'required|max:100',
        'no_tlp' => 'nullable|max:20',
    ], [
        'name.required' => 'Nama supplier wajib diisi.',
        'name.max'      => 'Nama supplier maksimal 100 karakter.',
        'no_tlp.max'    => 'Nomor telepon maksimal 20 karakter.',
    ]);

    Suppliers::create($validated);

    return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan!');
}
}
