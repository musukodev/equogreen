<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\Vendor;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QuotationFastExcelController extends Controller
{

    // Menampilkan form upload
    public function index()
    {
        return view('equogreen-frontend.buat_quotation');
    }

    // Memproses file excel yang diupload
    public function import(Request $request)
    {


        // 1. Validasi file
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ], [
            'file.required' => 'Mohon pilih file quotation terlebih dahulu.',
            'file.mimes' => 'Format berkas tidak sesuai! Mohon unggah berkas dengan format .xlsx, .xls, atau .csv.',
            'file.file' => 'Berkas yang diunggah tidak valid.'
        ]);
        $idVendor = Auth::user()->vendor->id_vendor;

        $idPenawaran = $request->id_penawaran;

        // 2. Ambil path sementara (temporary path) dari file yang diupload
        $path = $request->file('file')->getRealPath();

        // 3.5 Simpan file secara fisik untuk keperluan riwayat/tampilan
        $directory = "public/quotations/{$idPenawaran}_{$idVendor}";

        // 4. Proses import menggunakan FastExcel dengan penanganan error
        try {
            DB::beginTransaction();

            // Simpan backup data lama terlebih dahulu jika rollback diperlukan
            $oldQuotations = Quotation::where('id_vendor', $idVendor)
                ->where('id_penawaran', $idPenawaran)
                ->get();

            // Hapus data lama untuk di-replace
            Quotation::where('id_vendor', $idVendor)
                ->where('id_penawaran', $idPenawaran)
                ->delete();

            (new FastExcel)->import($path, function ($line) use ($idVendor, $idPenawaran) {
                // Cek validitas kolom minimal (wajib ada)
                if (!array_key_exists('material_no', $line) || !array_key_exists('description', $line) || !array_key_exists('qty', $line) || !array_key_exists('net_price', $line)) {
                    throw new \Exception("Format kolom Excel tidak sesuai template. Pastikan kolom wajib seperti 'material_no', 'description', 'qty', dan 'net_price' tersedia.");
                }

                // Cek agar baris tidak kosong
                if (empty($line['material_no']) && empty($line['description'])) {
                    return null;
                }

                return Quotation::create([
                    'id_vendor'       => $idVendor,
                    'id_penawaran'    => $idPenawaran,
                    'no_item'         => $line['no_item'] ?? null,
                    'coll_no'         => $line['coll_no'] ?? null,
                    'rfq_no'          => $line['rfq_no'] ?? null,
                    'material_no'     => $line['material_no'],
                    'description'     => $line['description'],
                    'qty'             => $line['qty'],
                    'uom'             => $line['uom'] ?? null,
                    'currency'        => $line['currency'] ?? 'IDR',
                    'net_price'       => $line['net_price'],
                    'incoterm'        => $line['incoterm'] ?? null,
                    'destination'     => $line['destination'] ?? null,
                    'remark_1'        => $line['remark_1'] ?? null,
                    'remark_2'        => $line['remark_2'] ?? null,
                    'payment_term'    => $line['payment_term'] ?? null,
                    'lead_time_weeks' => $line['lead_time_weeks'] ?? null,
                    'quotation_date'  => !empty($line['quotation_date']) ? $line['quotation_date'] : now()->toDateString(),
                    'status'          => 'pending'
                ]);
            });

            // Simpan file fisik jika sukses
            Storage::deleteDirectory($directory);
            $fileName = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs($directory, $fileName);

            DB::commit();

            // 5. Kirim email notifikasi ke Procurement pembuat batch & semua Superadmin
            try {
                $penawaran = \App\Models\Penawaran::with('batch.procurement')->find($idPenawaran);
                if ($penawaran && $penawaran->batch) {
                    $batch = $penawaran->batch;
                    $recipientEmails = [];

                    // Tambahkan email admin pembuat batch jika ada
                    if ($batch->procurement && $batch->procurement->email) {
                        $recipientEmails[] = $batch->procurement->email;
                    }

                    // Tambahkan email seluruh Superadmin
                    $superadminEmails = \App\Models\User::where('role', 'Superadmin')
                        ->with('procurement')
                        ->get()
                        ->map(fn($user) => $user->procurement?->email)
                        ->filter()
                        ->toArray();

                    $recipientEmails = array_unique(array_merge($recipientEmails, $superadminEmails));

                    if (!empty($recipientEmails)) {
                        $vendor = Vendor::find($idVendor);
                        if ($vendor) {
                            Mail::to($recipientEmails)->send(new \App\Mail\AdminQuotationSubmittedAlertMail($vendor, $batch));

                            // Simpan notifikasi in-app untuk pembuat batch
                            if ($batch->id_procurement) {
                                \App\Models\Pengumuman::create([
                                    'id_vendor' => null,
                                    'id_procurement' => $batch->id_procurement,
                                    'isi' => "Vendor " . $vendor->nama_perusahaan . " telah mengirimkan quotation untuk Batch " . $batch->id_batch . "."
                                ]);
                            }

                            // Simpan notifikasi in-app untuk seluruh Superadmin
                            $superadmins = \App\Models\User::where('role', 'Superadmin')->get();
                            foreach ($superadmins as $sa) {
                                if ($sa->id_procurement && $sa->id_procurement != $batch->id_procurement) {
                                    \App\Models\Pengumuman::create([
                                        'id_vendor' => null,
                                        'id_procurement' => $sa->id_procurement,
                                        'isi' => "Vendor " . $vendor->nama_perusahaan . " telah mengirimkan quotation untuk Batch " . $batch->id_batch . "."
                                    ]);
                                }
                            }
                        }
                    }
                }
            } catch (\Exception $mailEx) {
                // Log/ignore error email agar proses upload tetap dianggap sukses bagi vendor
            }
        } catch (\Exception $e) {
            DB::rollBack();
            // Kembalikan error secara ramah ke halaman uploader
            $errorMsg = $e->getMessage();
            if (str_contains($errorMsg, 'chk_quotation_qty')) {
                $errorMsg = 'Jumlah barang (qty) pada Excel harus lebih besar dari 0.';
            } elseif (str_contains($errorMsg, 'chk_quotation_net_price')) {
                $errorMsg = 'Harga satuan (net_price) pada Excel tidak boleh kurang dari 0.';
            } elseif (str_contains($errorMsg, 'chk_quotation_lead_time')) {
                $errorMsg = 'Lead time pada Excel tidak boleh kurang dari 0.';
            }

            return redirect()->back()->withErrors(['file' => 'Gagal mengimpor data: ' . $errorMsg])->withInput();
        }

        return redirect()->back()->with('success', 'Quotation berhasil terkirim');
    }

    // Mendownload file original quotation
    public function downloadOriginal($idPenawaran, $idVendor)
    {
        $directory = "public/quotations/{$idPenawaran}_{$idVendor}";
        $files = Storage::files($directory);

        if (empty($files)) {
            abort(404, 'File quotation tidak ditemukan.');
        }

        $filePath = $files[0];
        $fileName = basename($filePath);

        return Storage::download($filePath, $fileName);
    }
}
