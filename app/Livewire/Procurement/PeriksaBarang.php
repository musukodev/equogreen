<?php

namespace App\Livewire\Procurement;

use App\Models\Batch;
use App\Models\Penawaran;
use App\Models\PenawaranVendor;
use App\Models\Vendor;
use App\Models\Quotation;
use App\Models\Pengumuman;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Mail;
use App\Mail\VendorReminderMail;

#[Layout('components.layouts.app')]
#[Title('Detail Penawaran - Equogreen')]
class PeriksaBarang extends Component
{
    public $batch_id;
    public $group_id;
    public $search = '';
    public $status_pengajuan = '';

    public function mount($batch_id, $group_id)
    {
        $this->batch_id = $batch_id;
        $this->group_id = $group_id;
    }

    public function setujuiQuotation($id_vendor)
    {
        $vendor = Vendor::find($id_vendor);
        if (!$vendor) return;

        // Ambil penawaran terkait dari grup ini
        $penawarans = Penawaran::where('group_id', $this->group_id)->get();
        if ($penawarans->isEmpty()) return;

        $penawaranIds = $penawarans->pluck('id_penawaran');

        // 1. Update status quotation vendor terpilih menjadi approved
        Quotation::where('id_vendor', $id_vendor)
            ->whereIn('id_penawaran', $penawaranIds)
            ->update(['status' => 'approved']);

        // 2. Update status quotation vendor pesaing lain di dalam grup ini menjadi rejected
        Quotation::where('id_vendor', '!=', $id_vendor)
            ->whereIn('id_penawaran', $penawaranIds)
            ->update(['status' => 'rejected']);

        // 3. Masukkan notifikasi persetujuan ke tabel pengumuman untuk vendor approved
        $pesanApproved = "Selamat! Quotation Anda untuk Batch " . $this->batch_id . " telah disetujui oleh Procurement. Berkas PO telah diterbitkan.";
        Pengumuman::create([
            'id_vendor' => $id_vendor,
            'isi' => $pesanApproved,
        ]);

        // Kirim email notifikasi persetujuan ke vendor
        if ($vendor->email_perusahaan) {
            Mail::to($vendor->email_perusahaan)->send(new \App\Mail\VendorQuotationApprovedMail($vendor, $this->batch_id, $pesanApproved));
        }

        // 4. Masukkan notifikasi penolakan ke tabel pengumuman untuk vendor rejected
        $pesanRejected = "Mohon maaf, quotation Anda untuk Batch " . $this->batch_id . " tidak terpilih oleh Procurement. Terima kasih telah berpartisipasi.";
        $pesaingVendorIds = Vendor::whereIn('id_vendor', function($q) use ($penawaranIds, $id_vendor) {
            $q->select('id_vendor')->from('quotation')->whereIn('id_penawaran', $penawaranIds)->where('id_vendor', '!=', $id_vendor);
        })->pluck('id_vendor');

        foreach ($pesaingVendorIds as $pesaingId) {
            Pengumuman::create([
                'id_vendor' => $pesaingId,
                'isi' => $pesanRejected,
            ]);

            // Kirim email notifikasi penolakan ke vendor pesaing
            $pesaing = Vendor::find($pesaingId);
            if ($pesaing && $pesaing->email_perusahaan) {
                Mail::to($pesaing->email_perusahaan)->send(new \App\Mail\VendorQuotationRejectedMail($pesaing, $this->batch_id, $pesanRejected));
            }
        }

        // Arahkan ke halaman detail PO document
        $firstPenawaranId = $penawaranIds->first();
        return redirect()->route('po.show', ['id_vendor' => $id_vendor, 'id_penawaran' => $firstPenawaranId]);
    }

    public function kirimReminder($id_vendor)
    {
        $vendor = Vendor::find($id_vendor);
        if ($vendor && $vendor->email_perusahaan) {
            Mail::to($vendor->email_perusahaan)->send(new VendorReminderMail($vendor, $this->batch_id));

            // Masukkan pesan reminder ke tabel pengumuman
            $pesan = "Kami mengingatkan Anda untuk segera mengunggah Quotation untuk Batch " . $this->batch_id . ". Silakan login ke portal vendor Equogreen untuk melengkapi dokumen yang dibutuhkan.";
            Pengumuman::create([
                'id_vendor' => $vendor->id_vendor,
                'isi' => $pesan,
            ]);

            $this->dispatch('reminder-sent', nama_vendor: $vendor->nama_perusahaan);
        }
    }

    public function render()
    {
        $batch = Batch::findOrFail($this->batch_id);

        $penawarans = Penawaran::where('group_id', $this->group_id)->get();
        if ($penawarans->isEmpty()) {
            abort(404, 'Grup Penawaran tidak ditemukan.');
        }

        $penawaranIds = $penawarans->pluck('id_penawaran');

        $vendorIds = PenawaranVendor::whereIn('id_penawaran', $penawaranIds)->pluck('id_vendor')->unique();

        $query = Vendor::whereIn('id_vendor', $vendorIds)
            ->withCount(['quotations as sudah_mengajukan' => function ($q) use ($penawaranIds) {
                $q->whereIn('id_penawaran', $penawaranIds);
            }]);

        if ($this->search) {
            $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
        }

        if ($this->status_pengajuan === 'sudah') {
            $query->having('sudah_mengajukan', '>', 0);
        } elseif ($this->status_pengajuan === 'belum') {
            $query->having('sudah_mengajukan', '=', 0);
        }

        $vendors = $query->get();

        foreach ($vendors as $vendor) {
            if ($vendor->sudah_mengajukan > 0) {
                $q = Quotation::where('id_vendor', $vendor->id_vendor)
                    ->whereIn('id_penawaran', $penawaranIds)
                    ->first();
                $vendor->first_penawaran_id = $q ? $q->id_penawaran : null;
                $vendor->quotation_status = $q ? $q->status : 'pending';
            } else {
                $vendor->quotation_status = 'not_submitted';
            }
        }

        $backUrl = request()->query('from') === 'tambah'
            ? route('procurement-tambah_barang', ['batch_id' => $this->batch_id])
            : route('procurement-batch_barang');

        return view('livewire.procurement.periksa-barang', compact('batch', 'penawarans', 'vendors'))
            ->layoutData([
                'headerTitle' => 'Batch ' . $batch->id_batch,
                'backUrl' => $backUrl
            ]);
    }
}
