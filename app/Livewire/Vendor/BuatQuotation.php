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
    public $id_batch;
    public $isEditing = false;

    public function mount($id_batch)
{
    $this->id_batch = $id_batch;
}
    public function deleteQuotation()
    {
        $vendor_id = Auth::user()->vendor->id_vendor;
        $batch = Batch::where('id_batch', $this->id_batch)->with('penawaran')->firstOrFail();
        if ($batch->penawaran->isNotEmpty()) {
            $idPenawaran = $batch->penawaran->first()->id_penawaran;
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

        $batch = Batch::where('id_batch', $this->id_batch)
            ->whereHas('penawaran.penawaranVendors', function ($q) use ($vendor_id) {
                $q->where('id_vendor', $vendor_id);
            })
            ->with([
                'penawaran' => function ($q) use ($vendor_id) {
                    $q->whereHas('penawaranVendors', function ($q2) use ($vendor_id) {
                        $q2->where('id_vendor', $vendor_id);
                    });
                }
            ])
            ->firstOrFail();

        $hasUploaded = false;
        $uploadedFileName = null;
        $lastModified = null;

        if ($batch->penawaran->isNotEmpty()) {
            $idPenawaran = $batch->penawaran->first()->id_penawaran;
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

        return view('livewire.vendor.buat-quotation', [
            'batch' => $batch,
            'hasUploaded' => $hasUploaded,
            'uploadedFileName' => $uploadedFileName,
            'lastModified' => $lastModified
        ]);
    }
}
