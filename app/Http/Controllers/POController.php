<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseOrderMail;

class POController extends Controller
{
    private function getPOData($id_vendor, $id_penawaran)
    {
        $vendor = Vendor::findOrFail($id_vendor);
        
        $quotations = Quotation::with('penawaran.batch')
            ->where('id_vendor', $id_vendor)
            ->where('id_penawaran', $id_penawaran)
            ->get();

        if ($quotations->isEmpty()) {
            abort(404, 'Data Quotation tidak ditemukan');
        }

        // Hitung total
        $total = 0;
        foreach ($quotations as $q) {
            $total += ($q->qty * $q->net_price);
        }

        return compact('vendor', 'quotations', 'total');
    }

    public function show($id_vendor, $id_penawaran)
    {
        $data = $this->getPOData($id_vendor, $id_penawaran);
        return view('equogreen-frontend.po_document', $data);
    }

    public function downloadPdf($id_vendor, $id_penawaran)
    {
        $data = $this->getPOData($id_vendor, $id_penawaran);
        $pdf = Pdf::loadView('equogreen-frontend.po_pdf', $data);
        
        return $pdf->download('PO_' . $data['vendor']->nama_perusahaan . '_' . date('Ymd') . '.pdf');
    }

    public function sendEmail($id_vendor, $id_penawaran)
    {
        $data = $this->getPOData($id_vendor, $id_penawaran);
        $pdf = Pdf::loadView('equogreen-frontend.po_pdf', $data);
        
        try {
            Mail::to($data['vendor']->email_perusahaan)->send(new PurchaseOrderMail($data, $pdf->output()));
            return back()->with('success', 'PO Document berhasil dikirim ke ' . $data['vendor']->email_perusahaan);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}
