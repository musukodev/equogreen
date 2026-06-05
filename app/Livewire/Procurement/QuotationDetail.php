<?php

namespace App\Livewire\Procurement;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Quotation;
use App\Models\Vendor;

class QuotationDetail extends Component
{
    public $showModal = false;
    public $vendor;
    public $quotations = [];

    #[On('openQuotationModal')]
    public function openModal($idVendor)
    {
        $this->vendor = Vendor::find($idVendor);
        $this->quotations = Quotation::where('id_vendor', $idVendor)->get();
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