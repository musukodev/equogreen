<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('equogreen-frontend.login');
});
Route::get('/batch_barang', function () {
    return view('equogreen-frontend.batch_barang');
});
Route::get('/buat_quotation', function () {
    return view('equogreen-frontend.buat_quotation');
});
Route::get('/dashboard_procurement', function () {
    return view('equogreen-frontend.dashboard_procurement');
});
Route::get('/dashboard_vendor', function () {
    return view('equogreen-frontend.dashboard_vendor');
});
Route::get('/notifikasi', function () {
    return view('equogreen-frontend.notifikasi');
});
Route::get('/periksa_barang', function () {
    return view('equogreen-frontend.periksa_barang');
});
Route::get('/tambah_barang', function () {
    return view('equogreen-frontend.tambah_barang');
});
Route::get('/validasi-vendor', function () {
    return view('equogreen-frontend.validasi-vendor');
});
Route::get('/registrasi', function () {
    return view('equogreen-frontend.registrasi');
});
Route::get('/batch-list', function () {
    return view('equogreen-frontend.batch-list');
});