<?php

namespace App\Livewire\Procurement;

use App\Models\Batch;
use App\Models\Penawaran;
use App\Models\PenawaranVendor;
use App\Models\Vendor;
use App\Models\Quotation;
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

    public function kirimReminder($id_vendor)
    {
        $vendor = Vendor::find($id_vendor);
        if ($vendor && $vendor->email_perusahaan) {
            Mail::to($vendor->email_perusahaan)->send(new VendorReminderMail($vendor, $this->batch_id));
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Reminder sent to ' . $vendor->nama_perusahaan]);
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
            ->withCount(['quotations as sudah_mengajukan' => function($q) use ($penawaranIds) {
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
            }
        }

        return view('livewire.procurement.periksa-barang', compact('batch', 'penawarans', 'vendors'));
    }
}
