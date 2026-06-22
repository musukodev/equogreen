<?php

namespace App\Livewire\Vendor;

use App\Models\Batch;
use App\Models\Pengumuman;
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

        // Ambil data pengumuman/notifikasi untuk vendor ini
        $notifications = [];
        if ($vendor_id) {
            $notifications = Pengumuman::where('id_vendor', $vendor_id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('livewire.vendor.dashboard', [
            'batches' => $batches,
            'notifications' => $notifications
        ]);
    }
}
