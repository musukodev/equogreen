<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationFastExcelController;
use App\Http\Controllers\VendorController;
use App\Models\Quotation;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

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

    Route::get('/dashboard_vendor', \App\Livewire\Vendor\Dashboard::class)->name('vendor-dashboard');



    Route::get('/notifikasi', [App\Http\Controllers\NotifikasiController::class, 'index'])->name('procurement-notifikasi');

    Route::get('/vendor-profile', function () {
        return view('equogreen-frontend.profile_vendor');
    })->name('vendor_profile');
    Route::get('/procurement-profile', function () {
        return view('equogreen-frontend.profile_procurement');
    })->name('profile_procurement');

    Route::get('/periksa_barang', \App\Livewire\Procurement\PeriksaBarang::class)->name('procurement-periksa_barang');


    Route::get('/tambah_barang/{batch_id}', \App\Livewire\Procurement\TambahBarang::class)->name('procurement-tambah_barang');

    Route::get('/validasi-vendor', [VendorController::class, 'index'])->name('procurement-validasi-vendor');
    Route::post('/approve-vendor/{id}', [App\Http\Controllers\ValidateVendor::class, 'approveVendor'])->name('approve.vendor');
    Route::post('/reject-vendor/{id}', [App\Http\Controllers\ValidateVendor::class, 'rejectVendor'])->name('reject.vendor');

    Route::get('/batch-list', \App\Livewire\Procurement\BatchList::class)->name('procurement-batch-list');
    Route::get('/batch_barang', \App\Livewire\Procurement\BatchBarang::class)->name('procurement-batch_barang_empty');
    Route::get('/batch_barang/{year}', \App\Livewire\Procurement\BatchBarang::class)->name('procurement-batch_barang_by_year');

    Route::get('/buat_quotation/{id_batch}', \App\Livewire\Vendor\BuatQuotation::class)
        ->name('vendor-buat_quotation');

    Route::get('/po-document/{id_vendor}/{id_penawaran}', [App\Http\Controllers\POController::class, 'show'])->name('po.show');
    Route::get('/po-document/{id_vendor}/{id_penawaran}/pdf', [App\Http\Controllers\POController::class, 'downloadPdf'])->name('po.pdf');
    Route::post('/po-document/{id_vendor}/{id_penawaran}/email', [App\Http\Controllers\POController::class, 'sendEmail'])->name('po.email');

    Route::get('/vendor-riwayat', function () {
        $vendor_id = \Illuminate\Support\Facades\Auth::user()->vendor->id_vendor ?? null;
        
        if (!$vendor_id) {
            return redirect()->route('vendor-dashboard')->with('error', 'Vendor tidak ditemukan.');
        }

        // Ambil semua quotation milik vendor ini
        $allQuotations = \App\Models\Quotation::with('penawaran.batch')
            ->where('id_vendor', $vendor_id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Kelompokkan berdasarkan waktu upload (created_at) dan id_batch
        // Mengingat import excel dilakukan dalam waktu yang sama
        $history = [];
        foreach ($allQuotations as $q) {
            // Gunakan format waktu hingga menit untuk grouping
            $timeKey = $q->created_at ? $q->created_at->format('Y-m-d H:i') : 'Unknown Time';
            $batchId = $q->penawaran && $q->penawaran->batch ? $q->penawaran->batch->id_batch : 'Unknown';
            $groupKey = $timeKey . '_' . $batchId;

            if (!isset($history[$groupKey])) {
                $history[$groupKey] = [
                    'waktu' => $q->created_at ? $q->created_at->format('d-m-Y H:i') : '-',
                    'batch_id' => $batchId,
                    'items' => []
                ];
            }
            $history[$groupKey]['items'][] = $q;
        }

        return view('equogreen-frontend.riwayat_vendor', compact('history'));
    })->name('vendor-riwayat');

    Route::get('/fastexcel-quotation', [QuotationFastExcelController::class, 'index']);
    Route::post('/fastexcel-quotation', [QuotationFastExcelController::class, 'import'])->name('fastexcel.import');
    Route::get('/download-template', function () {
        return response()->download(
            public_path('templates/template_quotation.xlsx')
        );
    })->name('download-template');
});
