<?php

namespace App\Livewire\Vendor;

use App\Models\Batch;
use App\Models\Pengumuman;
use App\Models\Quotation;
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

        // Fetch penawaran that are assigned to this vendor, grouped by group_id
        $groupedPenawarans = \App\Models\Penawaran::whereHas('penawaranVendors', function ($q) use ($vendor_id) {
            $q->where('id_vendor', $vendor_id);
        })->with('batch')->get()->groupBy('group_id');

        // Ambil data pengumuman/notifikasi untuk vendor ini
        $notifications = [];
        if ($vendor_id) {
            $notifications = Pengumuman::where('id_vendor', $vendor_id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // Hitung metrik ringkasan quotation vendor
        $totalReview = 0;
        $totalApproved = 0;

        if ($vendor_id) {
            // Ambil semua penawaran id yang ditugaskan ke vendor ini
            $assignedPenawaranIds = \App\Models\Penawaran::whereHas('penawaranVendors', function ($q) use ($vendor_id) {
                $q->where('id_vendor', $vendor_id);
            })->pluck('id_penawaran');

            if ($assignedPenawaranIds->isNotEmpty()) {
                // Kelompokkan quotation berdasarkan id_penawaran (atau group_id) untuk menghitung unik
                $totalReview = Quotation::where('quotation.id_vendor', $vendor_id)
                    ->whereIn('quotation.id_penawaran', $assignedPenawaranIds)
                    ->where('quotation.status', 'pending')
                    ->join('penawaran', 'quotation.id_penawaran', '=', 'penawaran.id_penawaran')
                    ->select('penawaran.group_id')
                    ->distinct()
                    ->get()
                    ->count();

                $totalApproved = Quotation::where('quotation.id_vendor', $vendor_id)
                    ->whereIn('quotation.id_penawaran', $assignedPenawaranIds)
                    ->where('quotation.status', 'approved')
                    ->join('penawaran', 'quotation.id_penawaran', '=', 'penawaran.id_penawaran')
                    ->select('penawaran.group_id')
                    ->distinct()
                    ->get()
                    ->count();
            }
        }

        return view('livewire.vendor.dashboard', [
            'groupedPenawarans' => $groupedPenawarans,
            'notifications' => $notifications,
            'totalReview' => $totalReview,
            'totalApproved' => $totalApproved
        ])->layoutData([
            'headerTitle' => 'Dashboard',
            'headerDescription' => 'Akses semua quotation Anda dalam satu tempat'
        ]);
    }
}
