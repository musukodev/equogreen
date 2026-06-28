<?php

namespace App\Livewire\Procurement;

use App\Models\Vendor;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Daftar Vendor - Equogreen')]
class Notifikasi extends Component
{
    public function deleteVendor($idVendor)
    {
        $vendor = Vendor::findOrFail($idVendor);
        $vendor->delete();

        session()->flash('success', 'Akun vendor berhasil dihapus secara permanen dari sistem.');
    }

    public function render()
    {
        $vendors = Vendor::where('status', 'approved')->get();

        return view('livewire.procurement.notifikasi', compact('vendors'))
            ->layoutData([
                'headerTitle' => 'Daftar Vendor',
                'headerDescription' => 'Kelola dan lihat informasi seluruh vendor yang terdaftar'
            ]);
    }
}
