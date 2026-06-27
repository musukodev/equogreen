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
    public $group_id;
    public $isEditing = false;
    public $isExpired = false;
    public $isApproved = false;

    public function mount($group_id)
    {
        $this->group_id = $group_id;
        $vendor_id = Auth::user()->vendor->id_vendor;

        // Ambil data penawaran terkait grup ini
        $penawarans = \App\Models\Penawaran::where('group_id', $group_id)
            ->whereHas('penawaranVendors', function ($q) use ($vendor_id) {
                $q->where('id_vendor', $vendor_id);
            })
            ->with('batch')
            ->get();

        if ($penawarans->isEmpty()) {
            abort(404);
        }

        $batch = $penawarans->first()->batch;
        if ($batch) {
            $isExpired = now()->greaterThan(\Carbon\Carbon::parse($batch->waktu_selesai));
            
            // Pengecekan apakah vendor sudah pernah upload quotation
            $idPenawaran = $penawarans->first()->id_penawaran;
            $quotation = \App\Models\Quotation::where('id_vendor', $vendor_id)
                ->where('id_penawaran', $idPenawaran)
                ->first();
            $hasUploaded = $quotation ? true : false;
            $qStatus = $quotation ? $quotation->status : 'none';

            $this->isApproved = $qStatus === 'approved';

            // JIKA QUOTATION SUDAH DI-REJECT: blokir akses ke halaman ini
            if ($qStatus === 'rejected') {
                session()->flash('error', 'Quotation Anda untuk barang ini tidak terpilih. Anda tidak dapat mengakses halaman pengisian.');
                return redirect()->route('vendor-dashboard');
            }

            // JIKA EXPIRED dan BELUM UPLOAD: blokir akses ke halaman ini
            if ($isExpired && !$hasUploaded) {
                session()->flash('error', 'Batas waktu pengadaan untuk barang ini telah berakhir. Anda tidak dapat membuat quotation baru.');
                return redirect()->route('vendor-dashboard');
            }
        }
    }

    public function deleteQuotation()
    {
        // Proteksi jika waktu sudah habis atau sudah di-approve
        $vendor_id = Auth::user()->vendor->id_vendor;
        $penawarans = \App\Models\Penawaran::where('group_id', $this->group_id)->get();
        if ($penawarans->isEmpty()) return;

        $idPenawaran = $penawarans->first()->id_penawaran;
        $quotation = \App\Models\Quotation::where('id_vendor', $vendor_id)
            ->where('id_penawaran', $idPenawaran)
            ->first();
            
        if ($quotation && $quotation->status === 'approved') {
            session()->flash('error', 'Quotation Anda sudah disetujui. Anda tidak dapat menghapus quotation.');
            return;
        }

        $batch = $penawarans->first()->batch;
        if ($batch && now()->greaterThan(\Carbon\Carbon::parse($batch->waktu_selesai))) {
            session()->flash('error', 'Batas waktu pengadaan telah berakhir. Anda tidak dapat menghapus quotation.');
            return;
        }

        if ($penawarans->isNotEmpty()) {
            $idPenawaran = $penawarans->first()->id_penawaran;
            \App\Models\Quotation::where('id_vendor', $vendor_id)
                ->where('id_penawaran', $idPenawaran)
                ->delete();
                
            // Hapus file fisik
            \Illuminate\Support\Facades\Storage::deleteDirectory("public/quotations/{$idPenawaran}_{$vendor_id}");

            session()->flash('success', 'Quotation berhasil dihapus');
        }
    }

    public function render()
    {
        $vendor_id = Auth::user()->vendor->id_vendor;

        $penawarans = \App\Models\Penawaran::where('group_id', $this->group_id)
            ->whereHas('penawaranVendors', function ($q) use ($vendor_id) {
                $q->where('id_vendor', $vendor_id);
            })
            ->with('batch')
            ->get();
            
        abort_if($penawarans->isEmpty(), 404);
        
        $batch = $penawarans->first()->batch;
        $this->isExpired = $batch ? now()->greaterThan(\Carbon\Carbon::parse($batch->waktu_selesai)) : false;

        $hasUploaded = false;
        $uploadedFileName = null;
        $lastModified = null;

        if ($penawarans->isNotEmpty()) {
            $idPenawaran = $penawarans->first()->id_penawaran;
            $hasUploaded = \App\Models\Quotation::where('id_vendor', $vendor_id)
                ->where('id_penawaran', $idPenawaran)
                ->exists();
                
            if ($hasUploaded) {
                $directory = "public/quotations/{$idPenawaran}_{$vendor_id}";
                $files = \Illuminate\Support\Facades\Storage::files($directory);
                if (count($files) > 0) {
                    $uploadedFileName = basename($files[0]);
                    $lastModified = \Carbon\Carbon::createFromTimestamp(\Illuminate\Support\Facades\Storage::lastModified($files[0]))
                        ->translatedFormat('l, d F Y, h:i A'); // 'h:i A' untuk 11:58 PM
                }
            }
        }

        $notifications = [];
        if ($vendor_id) {
            $notifications = \App\Models\Pengumuman::where('id_vendor', $vendor_id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('livewire.vendor.buat-quotation', [
            'batch' => $batch,
            'penawarans' => $penawarans,
            'hasUploaded' => $hasUploaded,
            'uploadedFileName' => $uploadedFileName,
            'lastModified' => $lastModified,
            'notifications' => $notifications,
            'isExpired' => $this->isExpired,
            'isApproved' => $this->isApproved
        ])->layoutData([
            'headerTitle' => 'Buat Quotation',
            'headerDescription' => 'Isi quotation sesuai ketentuan yang berlaku',
            'backUrl' => route('vendor-dashboard')
        ]);
    }
}
