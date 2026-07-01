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
        // Keamanan Tambahan: Jika login sebagai vendor, pastikan hanya bisa membuka PO miliknya sendiri
        $user = auth()->user();
        if ($user && strtolower($user->role) === 'vendor') {
            if ($user->id_vendor != $id_vendor) {
                abort(403, 'Anda tidak diizinkan mengakses berkas PO vendor lain.');
            }
        }

        $vendor = Vendor::findOrFail($id_vendor);
        
        $quotations = Quotation::with('penawaran.batch.procurement')
            ->where('id_vendor', $id_vendor)
            ->where('id_penawaran', $id_penawaran)
            ->get();

        if ($quotations->isEmpty()) {
            abort(404, 'Data Quotation tidak ditemukan');
        }

        // Ambil nama procurement dari relasi batch
        $firstQuotation = $quotations->first();
        $procurementName = $firstQuotation->penawaran?->batch?->procurement?->nama_procurement ?? 'Procurement Team';

        // Hitung total
        $total = 0;
        foreach ($quotations as $q) {
            $total += ($q->qty * $q->net_price);
        }

        return compact('vendor', 'quotations', 'total', 'procurementName');
    }

    public function show($id_vendor, $id_penawaran)
    {
        $data = $this->getPOData($id_vendor, $id_penawaran);
        return view('po_document', $data);
    }

    public function downloadPdf($id_vendor, $id_penawaran)
    {
        $data = $this->getPOData($id_vendor, $id_penawaran);
        $pdf = Pdf::loadView('po_pdf', $data);
        
        return $pdf->download('PO_' . $data['vendor']->nama_perusahaan . '_' . date('Ymd') . '.pdf');
    }

    public function sendEmail($id_vendor, $id_penawaran)
    {
        if (auth()->check() && !in_array(strtolower(auth()->user()->role), ['procurement', 'superadmin'])) {
            abort(403, 'Hanya Procurement yang diizinkan mengirim PO melalui email.');
        }

        $data = $this->getPOData($id_vendor, $id_penawaran);
        $pdf = Pdf::loadView('po_pdf', $data);
        
        try {
            Mail::to($data['vendor']->email_perusahaan)->send(new PurchaseOrderMail($data, $pdf->output()));
            return back()->with('success', 'PO Document berhasil dikirim ke ' . $data['vendor']->email_perusahaan);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}
