<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});
Route::get('/batch_barang', function () {
    return view('batch_barang');
});
Route::get('/buat_quotation', function () {
    return view('buat_quotation');
});

Route::get('/dashboard_vendor', function () {
    return view('dashboard_vendor');
});
Route::get('/periksa_barang', function () {
    return view('periksa-barang-detail');
});
Route::get('/tambah_barang', function () {
    return view('tambah_barang');
});
Route::get('/registrasi', function () {
    return view('registrasi');
});