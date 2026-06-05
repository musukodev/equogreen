<?php

namespace App\Livewire\Procurement;

use App\Models\Quotation;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Periksa Barang - Equogreen')]  
class PeriksaBarang extends Component
{
    public $search = '';
    public $selectedBatch = '';
    public $selectedCategory = '';

    public function render()
    {
        $query = Quotation::with(['vendor', 'penawaran'])
            ->select('id_penawaran', 'id_vendor')
            ->groupBy('id_penawaran', 'id_vendor');

        if ($this->selectedBatch) {
            $query->whereHas('penawaran', function ($q) {
                $q->where('id_batch', $this->selectedBatch);
            });
        }

        if ($this->selectedCategory) {
            $query->whereHas('vendor', function ($q) {
                $q->where('kategori_vendor', $this->selectedCategory);
            });
        }

        if ($this->search) {
            $query->whereHas('vendor', function ($q) {
                $q->where('nama_perusahaan', 'like', '%' . $this->search . '%');
            });
        }

        $quotations = $query->get();

        $batches = \App\Models\Batch::orderBy('id_batch', 'asc')->get();
        
        $categories = \App\Models\Vendor::select('kategori_vendor')
            ->whereNotNull('kategori_vendor')
            ->where('kategori_vendor', '<>', '')
            ->distinct()
            ->pluck('kategori_vendor');

        return view('livewire.procurement.periksa-barang', compact('quotations', 'batches', 'categories'));
    }
}
