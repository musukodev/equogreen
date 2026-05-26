<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationFastExcelController;
use App\Http\Controllers\VendorController;
use App\Models\Quotation;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

// Root
Route::get('/', function () {
    if (Illuminate\Support\Facades\Auth::check()) {
        $user = Illuminate\Support\Facades\Auth::user();
        if (strtolower($user->role) === 'procurement') {
            return redirect()->route('procurement-dashboard');
        }
        return redirect()->route('vendor-dashboard');
    }
    return redirect()->route('login');
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

    Route::get('/dashboard_vendor', function () {
        return view('equogreen-frontend.dashboard_vendor');
    })->name('vendor-dashboard');

    // Procurement pages
    // (Digantikan dengan route /batch_barang/{year} di bawah)

    Route::get('/notifikasi', function () {
        return view('equogreen-frontend.notifikasi');
    })->name('procurement-notifikasi');

    Route::get('/periksa_barang', function () {
        return view('equogreen-frontend.periksa_barang');
    })->name('procurement-periksa_barang');

    Route::get('/tambah_barang', function () {
        return view('equogreen-frontend.tambah_barang');
    })->name('procurement-tambah_barang');

    Route::get('/validasi-vendor', [VendorController::class, 'index'])->name('procurement-validasi-vendor');
    Route::post('/approve-vendor/{id}', [App\Http\Controllers\ValidateVendor::class, 'approveVendor'])->name('approve.vendor');
    Route::post('/reject-vendor/{id}', [App\Http\Controllers\ValidateVendor::class, 'rejectVendor'])->name('reject.vendor');

    Route::get('/batch-list', \App\Livewire\Procurement\BatchList::class)->name('procurement-batch-list');
    Route::get('/batch_barang/{year}', \App\Livewire\Procurement\BatchBarang::class)->name('procurement-batch_barang_by_year');

    Route::get('/buat_quotation', function () {
        return view('equogreen-frontend.buat_quotation');
    })->name('vendor-buat_quotation');

    Route::get('/vendor-riwayat', function () {
        $quotations = Quotation::latest()->get();
        return view('equogreen-frontend.riwayat_vendor', compact('quotations'));
    })->name('vendor-riwayat');

    Route::get('/fastexcel-quotation', [QuotationFastExcelController::class, 'index']);
    Route::post('/fastexcel-quotation', [QuotationFastExcelController::class, 'import'])->name('fastexcel.import');
});