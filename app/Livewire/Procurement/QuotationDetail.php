<?php

namespace App\Livewire\Procurement;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Quotation;
use App\Models\Vendor;
use Illuminate\Support\Facades\Storage;

class QuotationDetail extends Component
{
    public $showModal = false;
    public $vendor;
    public $quotations = [];
    public $downloadUrl = null;
    public $fileName = null;

    #[On('openQuotationModal')]
    public function openModal($idVendor)
    {
        $this->vendor = Vendor::find($idVendor);
        $this->quotations = Quotation::where('id_vendor', $idVendor)->get();
        
        $this->downloadUrl = null;
        $this->fileName = null;

        $firstQuotation = $this->quotations->first();
        if ($firstQuotation) {
            $idPenawaran = $firstQuotation->id_penawaran;
            $directory = "public/quotations/{$idPenawaran}_{$idVendor}";
            $files = Storage::files($directory);
            
            if (!empty($files)) {
                $filePath = $files[0];
                $this->fileName = basename($filePath);
                // Ganti dengan route download khusus Laravel agar mendownload langsung dari private storage
                $this->downloadUrl = route('quotation.download', [
                    'id_penawaran' => $idPenawaran,
                    'id_vendor' => $idVendor
                ]);
            }
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.procurement.quotation-detail');
    }
}