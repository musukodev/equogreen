<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationFastExcelController;
use App\Http\Controllers\VendorController;
use App\Models\Quotation;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

// Root
Route::get('/', function () {
    return view('equogreen-frontend.landing');
});

// ── Registrasi vendor (tidak perlu login) ──────────────
Route::get('/registrasi', \App\Livewire\Auth\Register::class)->name('registrasi');


Route::post('/registrasi-store', \App\Livewire\Auth\Register::class)->name('registrasi-store');

// ── Semua route yang butuh login ───────────────────────
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard_procurement', \App\Livewire\Procurement\Dashboard::class)->name('procurement-dashboard');
    Route::get('/kelola-admin', \App\Livewire\Procurement\KelolaAdmin::class)->name('procurement-kelola-admin');

    Route::get('/dashboard_vendor', \App\Livewire\Vendor\Dashboard::class)->name('vendor-dashboard');



    Route::get('/notifikasi', \App\Livewire\Procurement\Notifikasi::class)->name('procurement-notifikasi');

    Route::get('/vendor-profile', \App\Livewire\Vendor\ProfileVendor::class)->name('vendor_profile');
    Route::get('/procurement-profile', \App\Livewire\Procurement\ProfileProcurement::class)->name('profile_procurement');

    Route::get('/periksa_barang/{batch_id}/{group_id}', \App\Livewire\Procurement\PeriksaBarang::class)->name('procurement-periksa_barang');


    Route::get('/tambah_barang/{batch_id}', \App\Livewire\Procurement\TambahBarang::class)->name('procurement-tambah_barang');

    Route::get('/validasi-vendor', \App\Livewire\Procurement\VendorController::class)->name('procurement-validasi-vendor');
    Route::get('/procurement/riwayat-po', \App\Livewire\Procurement\RiwayatPO::class)->name('procurement-riwayat-po');
    Route::post('/approve-vendor/{id}', [App\Http\Controllers\ValidateVendor::class, 'approveVendor'])->name('approve.vendor');
    Route::post('/reject-vendor/{id}', [App\Http\Controllers\ValidateVendor::class, 'rejectVendor'])->name('reject.vendor');

    Route::get('/batch_barang', \App\Livewire\Procurement\BatchBarang::class)->name('procurement-batch_barang');

    Route::get('/buat_quotation/{group_id}', \App\Livewire\Vendor\BuatQuotation::class)
        ->name('vendor-buat_quotation');

    Route::get('/po-document/{id_vendor}/{id_penawaran}', [App\Http\Controllers\POController::class, 'show'])->name('po.show');
    Route::get('/po-document/{id_vendor}/{id_penawaran}/pdf', [App\Http\Controllers\POController::class, 'downloadPdf'])->name('po.pdf');
    Route::post('/po-document/{id_vendor}/{id_penawaran}/email', [App\Http\Controllers\POController::class, 'sendEmail'])->name('po.email');

    Route::get('/vendor-riwayat', \App\Livewire\Vendor\Riwayat::class)->name('vendor-riwayat');

    Route::get('/fastexcel-quotation', [QuotationFastExcelController::class, 'index']);
    Route::post('/fastexcel-quotation', [QuotationFastExcelController::class, 'import'])->name('fastexcel.import');
    Route::get('/download-quotation/{id_penawaran}/{id_vendor}', [QuotationFastExcelController::class, 'downloadOriginal'])
        ->name('quotation.download');
    Route::get('/download-template', function () {
        return response()->download(
            public_path('templates/template_quotation.xlsx')
        );
    })->name('download-template');
});
