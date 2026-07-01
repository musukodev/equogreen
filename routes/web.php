<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationFastExcelController;
use App\Http\Controllers\VendorController;
use App\Models\Quotation;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

// Root / Landing
Route::get('/', function () {
    return view('equogreen-frontend.landing');
});

// Registrasi vendor (tidak perlu login)
Route::get('/registrasi', \App\Livewire\Auth\Register::class)->name('registrasi');
Route::post('/registrasi-store', \App\Livewire\Auth\Register::class)->name('registrasi-store');

// Semua route yang butuh login
Route::middleware('auth')->group(function () {

    // Profile General Laravel (Breeze standard)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── GRUP PROCUREMENT & SUPERADMIN (Prefix: /procurement) ──────────────────────────
    Route::middleware('role:Procurement,Superadmin')->prefix('procurement')->group(function () {
        // Dashboard utama procurement menggunakan /
        Route::get('/', \App\Livewire\Procurement\Dashboard::class)->name('procurement-dashboard');
        
        Route::get('/batch-barang', \App\Livewire\Procurement\BatchBarang::class)->name('procurement-batch_barang');
        Route::get('/notifikasi', \App\Livewire\Procurement\Notifikasi::class)->name('procurement-notifikasi');
        Route::get('/validasi-vendor', \App\Livewire\Procurement\VendorController::class)->name('procurement-validasi-vendor');
        Route::get('/riwayat-po', \App\Livewire\Procurement\RiwayatPO::class)->name('procurement-riwayat-po');
        Route::get('/periksa-barang/{batch_id}/{group_id}', \App\Livewire\Procurement\PeriksaBarang::class)->name('procurement-periksa_barang');
        Route::get('/tambah-barang/{batch_id}', \App\Livewire\Procurement\TambahBarang::class)->name('procurement-tambah_barang');
        Route::get('/profile', \App\Livewire\Procurement\ProfileProcurement::class)->name('profile_procurement');
        
        // Actions
        Route::post('/approve-vendor/{id}', [App\Http\Controllers\ValidateVendor::class, 'approveVendor'])->name('approve.vendor');
        Route::post('/reject-vendor/{id}', [App\Http\Controllers\ValidateVendor::class, 'rejectVendor'])->name('reject.vendor');
        Route::post('/po-document/{id_vendor}/{id_penawaran}/email', [App\Http\Controllers\POController::class, 'sendEmail'])->name('po.email');
    });

    // ── GRUP KHUSUS SUPERADMIN (Prefix: /procurement) ──────────────────────────────
    Route::middleware('role:Superadmin')->prefix('procurement')->group(function () {
        Route::get('/kelola-admin', \App\Livewire\Procurement\KelolaAdmin::class)->name('procurement-kelola-admin');
    });

    // ── GRUP KHUSUS VENDOR (Prefix: /vendor) ────────────────────────────────────────
    Route::middleware('role:Vendor')->prefix('vendor')->group(function () {
        // Dashboard utama vendor menggunakan /
        Route::get('/', \App\Livewire\Vendor\Dashboard::class)->name('vendor-dashboard');
        
        Route::get('/buat-quotation/{group_id}', \App\Livewire\Vendor\BuatQuotation::class)->name('vendor-buat_quotation');
        Route::get('/riwayat', \App\Livewire\Vendor\Riwayat::class)->name('vendor-row-riwayat'); // renamed route internally to avoid name conflict with old name but binding vendor-riwayat to keep views working:
        Route::get('/riwayat-penawaran', \App\Livewire\Vendor\Riwayat::class)->name('vendor-riwayat');
        Route::get('/profile', \App\Livewire\Vendor\ProfileVendor::class)->name('vendor_profile');
        
        // Actions
        Route::post('/fastexcel-quotation', [QuotationFastExcelController::class, 'import'])->name('fastexcel.import');
    });

    // ── AKSI GLOBAL / FILE DOWNLOAD ────────────────────────────────────────────────
    Route::get('/po-document/{id_vendor}/{id_penawaran}', [App\Http\Controllers\POController::class, 'show'])->name('po.show');
    Route::get('/po-document/{id_vendor}/{id_penawaran}/pdf', [App\Http\Controllers\POController::class, 'downloadPdf'])->name('po.pdf');
    Route::get('/download-quotation/{id_penawaran}/{id_vendor}', [QuotationFastExcelController::class, 'downloadOriginal'])
        ->name('quotation.download');
    Route::get('/download-template', function () {
        return response()->download(public_path('templates/template_quotation.xlsx'));
    })->name('download-template');
});
