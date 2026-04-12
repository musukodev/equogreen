<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('batch_barang');
});
Route::get('/batch_barang', function () {
    return view('batch_barang');
});
Route::get('/buat_quotation', function () {
    return view('buat_quotation');
});
Route::get('/batch1', function () {
    return view('batch1');
});
Route::get('/edit_batch', function () {
    return view('edit_batch');
});
Route::get('/dashboard_vendor', function () {
    return view('dashboard_vendor');
});
Route::get('/periksa_barang', function () {
    return view('periksa_barang');
});
Route::get('/tambah_batch', function () {
    return view('tambah_batch');
});