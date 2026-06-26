<?php

namespace App\Livewire\Vendor;

use App\Models\Batch;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Buat Quotation - Equogreen')]
class BuatQuotation extends Component
{
    public $group_id;
    public $isEditing = false;

    public function mount($group_id)
{
    $this->group_id = $group_id;
}
    public function deleteQuotation()
    {
        $vendor_id = Auth::user()->vendor->id_vendor;
        $penawarans = \App\Models\Penawaran::where('group_id', $this->group_id)->get();
        if ($penawarans->isNotEmpty()) {
            $idPenawaran = $penawarans->first()->id_penawaran;
            \App\Models\Quotation::where('id_vendor', $vendor_id)
                ->where('id_penawaran', $idPenawaran)
                ->delete();
                
            // Hapus file fisik
            \Illuminate\Support\Facades\Storage::deleteDirectory("public/quotations/{$idPenawaran}_{$vendor_id}");

            session()->flash('success', 'Quotation berhasil dihapus');
        }
    }

    public function render()
    {
        $vendor_id = Auth::user()->vendor->id_vendor;

        $penawarans = \App\Models\Penawaran::where('group_id', $this->group_id)
            ->whereHas('penawaranVendors', function ($q) use ($vendor_id) {
                $q->where('id_vendor', $vendor_id);
            })
            ->with('batch')
            ->get();
            
        abort_if($penawarans->isEmpty(), 404);
        
        $batch = $penawarans->first()->batch;

        $hasUploaded = false;
        $uploadedFileName = null;
        $lastModified = null;

        if ($penawarans->isNotEmpty()) {
            $idPenawaran = $penawarans->first()->id_penawaran;
            $hasUploaded = \App\Models\Quotation::where('id_vendor', $vendor_id)
                ->where('id_penawaran', $idPenawaran)
                ->exists();
                
            if ($hasUploaded) {
                $directory = "public/quotations/{$idPenawaran}_{$vendor_id}";
                $files = \Illuminate\Support\Facades\Storage::files($directory);
                if (count($files) > 0) {
                    $uploadedFileName = basename($files[0]);
                    $lastModified = \Carbon\Carbon::createFromTimestamp(\Illuminate\Support\Facades\Storage::lastModified($files[0]))
                        ->translatedFormat('l, d F Y, h:i A'); // 'h:i A' untuk 11:58 PM
                }
            }
        }

        $notifications = [];
        if ($vendor_id) {
            $notifications = \App\Models\Pengumuman::where('id_vendor', $vendor_id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('livewire.vendor.buat-quotation', [
            'batch' => $batch,
            'penawarans' => $penawarans,
            'hasUploaded' => $hasUploaded,
            'uploadedFileName' => $uploadedFileName,
            'lastModified' => $lastModified,
            'notifications' => $notifications
        ]);
    }
}
