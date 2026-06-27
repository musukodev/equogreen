<?php

namespace App\Livewire\Vendor;

use App\Models\Quotation;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Riwayat - Equogreen')]
class Riwayat extends Component
{
    public function render()
    {
        $vendor_id = Auth::user()->vendor->id_vendor ?? null;

        if (!$vendor_id) {
            session()->flash('error', 'Vendor tidak ditemukan.');
            return redirect()->route('vendor-dashboard');
        }

        // Ambil semua quotation milik vendor ini
        $allQuotations = Quotation::with('penawaran.batch')
            ->where('id_vendor', $vendor_id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Kelompokkan berdasarkan waktu upload (created_at) dan id_batch
        $history = [];
        foreach ($allQuotations as $q) {
            $timeKey = $q->created_at ? $q->created_at->format('Y-m-d H:i') : 'Unknown Time';
            $batchId = $q->penawaran && $q->penawaran->batch ? $q->penawaran->batch->id_batch : 'Unknown';
            $groupKey = $timeKey . '_' . $batchId;

            if (!isset($history[$groupKey])) {
                $history[$groupKey] = [
                    'waktu' => $q->created_at ? $q->created_at->format('d-m-Y H:i') : '-',
                    'batch_id' => $batchId,
                    'items' => []
                ];
            }
            $history[$groupKey]['items'][] = $q;
        }

        // Ambil data pengumuman/notifikasi untuk vendor ini
        $notifications = Pengumuman::where('id_vendor', $vendor_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.vendor.riwayat', [
            'history' => $history,
            'notifications' => $notifications
        ])->layoutData([
            'headerTitle' => 'Riwayat',
            'headerDescription' => 'Kelola dan lihat riwayat penawaran yang telah Anda kirimkan'
        ]);
    }
}
