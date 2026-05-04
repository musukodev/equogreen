<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use Rap2hpoutre\FastExcel\FastExcel;

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

        // 2. Ambil path sementara (temporary path) dari file yang diupload
        $path = $request->file('file')->getRealPath();

        // 3. Proses import menggunakan FastExcel
        (new FastExcel)->import($path, function ($line) {
            // $line adalah array asosiatif per baris dari file Excel.
            // Key-nya (seperti 'nama', 'email') SANGAT bergantung pada 
            // teks di baris pertama (header) file Excel Anda.

            return Quotation::create([
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

        return redirect()->back();
    }
}
