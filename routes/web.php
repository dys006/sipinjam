<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})-> name ('homepage');

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
   
   Route::get('/alat', function () {
    $alat = [
    ['kode' => 'ALT-0001', 'nama' => 'Multimeter Digital', 'kategori' => 'Alat
   Ukur', 'stok' => 5],
    ['kode' => 'ALT-0002', 'nama' => 'Osiloskop', 'kategori' => 'Alat
   Ukur', 'stok' => 0],
    ['kode' => 'ALT-0003', 'nama' => 'Solder 40 Watt', 'kategori' => 'Alat
   Solder', 'stok' => 8],
    ['kode' => 'ALT-0004', 'nama' => 'Arduino Uno', 'kategori' =>
   'Mikrokontroler', 'stok' => 12],
    ['kode' => 'ALT-0005', 'nama' => 'Tang Potong', 'kategori' =>
   'Perkakas', 'stok' => 3],
   ['kode' => 'ALT-0006', 'nama' => 'Jangka Sorong', 'kategori' =>
   'Alat Ukur', 'stok' => 10],
   ['kode' => 'ALT-0007', 'nama' => 'Sensor Ultrasonik', 'kategori' =>
   'Sensor', 'stok' => 0],
    ];
    return view('alat', ['alat' => $alat]);
   });
   
   Route::get('/dashboard', function () {
    return view('dashboard');
   });
   