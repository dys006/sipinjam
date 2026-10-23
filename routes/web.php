<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Item;
use App\Models\Loan;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\SuppliersController;

 Route::resource('/suppliers', SuppliersController::class)->only(['index', 'create', 'store']);


// Hanya untuk tamu (belum login)
Route::middleware('guest')->group(function () {
 Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
 Route::post('/login', [AuthController::class, 'login']);
 Route::get('/daftar', [AuthController::class, 'showRegister'])->name('daftar');
 Route::post('/daftar', [AuthController::class, 'register']);
});
// Wajib login
Route::middleware('auth')->group(function () {
 Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
 Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 Route::resource('peminjaman', LoanController::class)->only(['index', 'create','store']);

 // Khusus admin
 Route::middleware('admin')->group(function () {
 Route::resource('kategori', CategoryController::class)->except('show');
 Route::resource('alat', ItemController::class)->except(['index', 'show']);
 Route::patch('/peminjaman/{peminjaman}/kembali', [LoanController::class,'kembalikan'])->name('peminjaman.kembali');

 });
 // Semua yang sudah login: melihat daftar alat
 Route::get('/alat', [ItemController::class, 'index'])->name('alat.index');
});


Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/halamandepan', function () {
    return view('halamandepan');
});

Route::get('/halamanbaru', function () {
    return view('halamanbaru');
})->name('halamanbaru');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/profil', function () {
    return view('profil', [
        'nama' => 'Dhiya Nasywa',
        'nim' => '225443030',
        'kelas' => '2AEC2',
        'prodi' => 'TRIN',
        'kampus' => 'Politeknik Manufaktur Bandung',
        'hobi' => 'Bermain Gitar',
        'alamat' => 'JL. Kolonel Masturi'
    ]);
});

Route::get('/latihan-blade', function () {
    return view('latihan-blade', [
        'nilai' => 60,
        'hobi' => ['Membaca', 'Bermain futsal', 'Ngoding'],
        'kosong' => [],
        'catatan' => '<b>Teks ini tebal</b>',
    ]);
});

Route::resource('alat', ItemController::class)->except('show');


Route::resource('kategori', CategoryController::class)->except('show');

