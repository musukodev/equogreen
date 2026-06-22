<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);
        $idVendor = Auth::user()->vendor->id_vendor;

        $idPenawaran = $request->id_penawaran;

        // 2. Ambil path sementara (temporary path) dari file yang diupload
        $path = $request->file('file')->getRealPath();

        // 3. Hapus data quotation lama untuk vendor dan penawaran ini (agar replace/ubah file berfungsi)
        Quotation::where('id_vendor', $idVendor)
            ->where('id_penawaran', $idPenawaran)
            ->delete();

        // 3.5 Simpan file secara fisik untuk keperluan riwayat/tampilan
        $directory = "public/quotations/{$idPenawaran}_{$idVendor}";
        Storage::deleteDirectory($directory); // hapus file lama jika ada
        
        $fileName = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs($directory, $fileName);

        // 4. Proses import menggunakan FastExcel
        (new FastExcel)->import($path, function ($line) use ($idVendor, $idPenawaran) {
            // $line adalah array asosiatif per baris dari file Excel.
            // Key-nya (seperti 'nama', 'email') SANGAT bergantung pada 
            // teks di baris pertama (header) file Excel Anda.

            return Quotation::create([
                'id_vendor'       => $idVendor,
                'id_penawaran'    => $idPenawaran,

                'no_item'         => $line['no_item'],
                'coll_no'         => $line['coll_no'],
                'rfq_no'          => $line['rfq_no'],
                'material_no'     => $line['material_no'],
                'description'     => $line['description'],
                'qty'             => $line['qty'],
                'uom'             => $line['uom'],
                'currency'        => $line['currency'],
                'net_price'       => $line['net_price'],
                'incoterm'        => $line['incoterm'],
                'destination'     => $line['destination'],
                'remark_1'        => $line['remark_1'],
                'remark_2'        => $line['remark_2'],
                'payment_term'    => $line['payment_term'],
                'lead_time_weeks' => $line['lead_time_weeks'],
                'quotation_date'  => $line['quotation_date'],
            ]);
        });

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
