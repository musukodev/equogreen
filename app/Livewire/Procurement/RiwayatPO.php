<?php

namespace App\Livewire\Procurement;

use App\Models\Quotation;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Riwayat PO - Equogreen')]
class RiwayatPO extends Component
{
    public $search = '';

    public function render()
    {
        // Get unique combination of id_vendor and id_penawaran from quotation
        $query = Quotation::with(['vendor', 'penawaran.batch'])
            ->select('id_vendor', 'id_penawaran')
            ->selectRaw('MAX(created_at) as tanggal')
            ->groupBy('id_vendor', 'id_penawaran');

        if ($this->search) {
            $query->whereHas('vendor', function ($q) {
                $q->where('nama_perusahaan', 'like', '%' . $this->search . '%');
            });
        }

        $pos = $query->orderBy('tanggal', 'desc')->get();

        return view('livewire.procurement.riwayat-po', compact('pos'))
            ->layoutData([
                'headerTitle' => 'Riwayat PO',
                'headerDescription' => 'Lihat riwayat Purchase Order yang telah dikirim ke vendor'
            ]);
    }
}
