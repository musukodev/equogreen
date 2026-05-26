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
    public function render()
    {
        $vendor_id = Auth::user()->id_vendor;

        // Fetch batches that have penawaran assigned to this vendor
        $batches = Batch::whereHas('penawaran.penawaranVendors', function($q) use ($vendor_id) {
            $q->where('id_vendor', $vendor_id);
        })->with(['penawaran' => function($q) use ($vendor_id) {
            // Only load penawaran assigned to this vendor
            $q->whereHas('penawaranVendors', function($q2) use ($vendor_id) {
                $q2->where('id_vendor', $vendor_id);
            });
        }])->get();

        return view('livewire.vendor.buat-quotation', [
            'batches' => $batches
        ]);
    }
}
