<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';


// Tambahkan di atas, sebelum route lainnya
Route::get('/', function () {
    return view('equogreen-frontend.login');
})->name('login')->middleware('guest');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/batch_barang', function () {
    return view('equogreen-frontend.batch_barang');
})->name('procurement-batch_barang');
Route::get('/buat_quotation', function () {
    return view('equogreen-frontend.buat_quotation');
})->name('vendor-buat_quotation');
Route::middleware('auth')->group(function () {

Route::get('/dashboard_procurement', function () {
    return view('equogreen-frontend.dashboard_procurement');
})->name('procurement-dashboard');
Route::get('/dashboard_vendor', function () {
    return view('equogreen-frontend.dashboard_vendor');
})->name('vendor-dashboard');
});
Route::get('/notifikasi', function () {
    return view('equogreen-frontend.notifikasi');
})->name('procurement-notifikasi');
Route::get('/periksa_barang', function () {
    return view('equogreen-frontend.periksa_barang');
})->name('procurement-periksa_barang');
Route::get('/tambah_barang', function () {
    return view('equogreen-frontend.tambah_barang');
})->name('procurement-tambah_barang');
Route::get('/validasi-vendor', function () {
    return view('equogreen-frontend.validasi-vendor');
})->name('procurement-validasi-vendor');
Route::get('/registrasi', function () {
    return view('equogreen-frontend.registrasi');
})->name('registrasi');
Route::get('/vendor-riwayat', function () {
    return view('equogreen-frontend.riawayat_vendor');
})->name('vendor-riwayat');
Route::get('/batch-list', function () {
    return view('equogreen-frontend.batch-list');
})->name('procurement-batch-list');



