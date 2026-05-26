<?php

namespace App\Livewire\Vendor;

use App\Models\Batch;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Dashboard Vendor - Equogreen')]
class Dashboard extends Component
{
    public function render()
    {
        $vendor_id = Auth::user()->id_vendor;

        // Fetch batches that have penawaran assigned to this vendor
        $batches = Batch::whereHas('penawaran.penawaranVendors', function($q) use ($vendor_id) {
            $q->where('id_vendor', $vendor_id);
        })->get();

        return view('livewire.vendor.dashboard', [
            'batches' => $batches
        ]);
    }
}
