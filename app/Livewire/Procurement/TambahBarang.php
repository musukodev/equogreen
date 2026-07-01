<?php

namespace App\Livewire\Procurement;

use App\Models\Batch;
use App\Models\Penawaran;
use App\Models\PenawaranVendor;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Tambah Barang - Equogreen')]
class TambahBarang extends Component
{
    public $batch_id;
    public $kategori_terpilih = 'atk';
    public $selected_vendors = [];
    public $items = [
        ['nama_barang' => '', 'spesifikasi' => '', 'jumlah' => '']
    ];
    public $vendors = [];
    public $savedPenawaran = [];
    public $edit_id = null;

    public function mount($batch_id)
    {
        $this->batch_id = $batch_id;
        $this->loadVendors();
        $this->loadPenawaran();
    }

    public function updatedKategoriTerpilih()
    {
        $this->selected_vendors = [];
        $this->loadVendors();
    }

    public function loadVendors()
    {
        $this->vendors = Vendor::where('status', 'approved')
            ->where('kategori_vendor', $this->kategori_terpilih)
            ->get()
            ->toArray();
    }

    public function loadPenawaran()
    {
        $allPenawaran = Penawaran::with('penawaranVendors.vendor')
            ->where('id_batch', $this->batch_id)
            ->get();

        $grouped = [];
        foreach ($allPenawaran as $penawaran) {
            $key = $penawaran->group_id ?: 'old-'.$penawaran->id_penawaran; 
            if (!isset($grouped[$key])) {
                // Ambil kategori dari salah satu vendor
                $firstVendor = $penawaran->penawaranVendors->first()->vendor ?? null;
                $kategori = $firstVendor ? $firstVendor->kategori_vendor : 'Umum';

                $grouped[$key] = [
                    'group_id' => $key,
                    'items' => [],
                    'kategori' => strtoupper($kategori),
                    'vendors' => $penawaran->penawaranVendors->map(function($pv) {
                        return $pv->vendor->nama_perusahaan ?? 'Unknown';
                    })->unique()->values()->all()
                ];
            }
            $grouped[$key]['items'][] = $penawaran;
        }

        $this->savedPenawaran = array_values($grouped);
    }

    public function addBaris()
    {
        $this->items[] = ['nama_barang' => '', 'spesifikasi' => '', 'jumlah' => ''];
    }

    public function hapusBaris($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        if (empty($this->items)) {
            $this->addBaris();
        }
    }

    public function store()
    {
        $this->validate([
            'selected_vendors' => 'required|array|min:1',
            'items.*.nama_barang' => 'required|string',
            'items.*.spesifikasi' => 'required|string',
            'items.*.jumlah' => 'required|integer|min:1',
        ], [
            'selected_vendors.required' => 'Pilih minimal satu vendor.',
            'items.*.nama_barang.required' => 'Nama barang wajib diisi.',
            'items.*.spesifikasi.required' => 'Spesifikasi wajib diisi.',
            'items.*.jumlah.required' => 'Jumlah wajib diisi dan lebih dari 0.',
        ]);

        DB::beginTransaction();
        try {
            if ($this->edit_id) {
                // Hapus vendor lama dan penawaran lama
                $oldPenawarans = Penawaran::where('group_id', $this->edit_id)->get();
                if ($oldPenawarans->isEmpty()) {
                    // Fallback for old data without group_id
                    $oldPenawarans = Penawaran::where('id_penawaran', str_replace('old-', '', $this->edit_id))->get();
                }

                foreach($oldPenawarans as $p) {
                    PenawaranVendor::where('id_penawaran', $p->id_penawaran)->delete();
                    $p->delete();
                }

                foreach ($this->items as $item) {
                    $penawaran = Penawaran::create([
                        'id_batch' => $this->batch_id,
                        'group_id' => $this->edit_id, // Reuse the same group_id
                        'nama_barang' => $item['nama_barang'],
                        'spesifikasi' => $item['spesifikasi'],
                        'jumlah' => $item['jumlah'],
                    ]);

                    foreach ($this->selected_vendors as $vendorId) {
                        PenawaranVendor::create([
                            'id_penawaran' => $penawaran->id_penawaran,
                            'id_vendor' => $vendorId
                        ]);
                    }
                }

                session()->flash('success', 'Barang berhasil diupdate!');
                $this->edit_id = null;
            } else {
                // Insert mode
                $groupId = Str::uuid()->toString();
                foreach ($this->items as $item) {
                    $penawaran = Penawaran::create([
                        'id_batch' => $this->batch_id,
                        'group_id' => $groupId,
                        'nama_barang' => $item['nama_barang'],
                        'spesifikasi' => $item['spesifikasi'],
                        'jumlah' => $item['jumlah'],
                    ]);

                    foreach ($this->selected_vendors as $vendorId) {
                        PenawaranVendor::create([
                            'id_penawaran' => $penawaran->id_penawaran,
                            'id_vendor' => $vendorId
                        ]);
                    }
                }

                // 1. Simpan notifikasi in-app untuk masing-masing vendor yang dipilih
                $pesan = "Anda menerima permintaan penawaran baru (RFQ) untuk Batch " . $this->batch_id . ". Silakan unggah berkas quotation Anda.";
                foreach ($this->selected_vendors as $vendorId) {
                    \App\Models\Pengumuman::create([
                        'id_vendor' => $vendorId,
                        'id_procurement' => null,
                        'isi' => $pesan,
                        'is_read' => false
                    ]);

                    // 2. Kirim email notifikasi RFQ baru ke masing-masing vendor
                    $vendor = \App\Models\Vendor::find($vendorId);
                    if ($vendor && $vendor->email_perusahaan) {
                        \Illuminate\Support\Facades\Mail::to($vendor->email_perusahaan)->send(
                            new \App\Mail\VendorNewRFQMail($vendor, $this->batch_id, $this->items)
                        );
                    }
                }

                session()->flash('success', 'Barang berhasil ditambahkan!');
            }

            DB::commit();

            // Reset form
            $this->items = [['nama_barang' => '', 'spesifikasi' => '', 'jumlah' => '']];
            $this->selected_vendors = [];
            $this->loadPenawaran();

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function editPenawaran($groupId)
    {
        $penawarans = Penawaran::with('penawaranVendors')->where('group_id', $groupId)->get();
        if ($penawarans->isEmpty()) {
            // Fallback for old data
            $penawarans = Penawaran::with('penawaranVendors')->where('id_penawaran', str_replace('old-', '', $groupId))->get();
        }
        
        if ($penawarans->isEmpty()) return;

        $this->edit_id = $groupId;
        $this->items = [];
        
        foreach ($penawarans as $p) {
            $this->items[] = [
                'nama_barang' => $p->nama_barang,
                'spesifikasi' => $p->spesifikasi,
                'jumlah' => $p->jumlah
            ];
        }

        // Ambil vendor terpilih
        $this->selected_vendors = $penawarans->first()->penawaranVendors->pluck('id_vendor')->toArray();

        // Coba setel kategori dropdown berdasarkan salah satu vendor, asumsikan vendor dalam satu kategori yg sama
        if (count($this->selected_vendors) > 0) {
            $vendor = Vendor::find($this->selected_vendors[0]);
            if ($vendor) {
                $this->kategori_terpilih = $vendor->kategori_vendor;
                $this->loadVendors();
            }
        }
    }

    public function deletePenawaran($groupId)
    {
        DB::beginTransaction();
        try {
            $penawarans = Penawaran::where('group_id', $groupId)->get();
            if ($penawarans->isEmpty()) {
                $penawarans = Penawaran::where('id_penawaran', str_replace('old-', '', $groupId))->get();
            }

            foreach ($penawarans as $p) {
                PenawaranVendor::where('id_penawaran', $p->id_penawaran)->delete();
                $p->delete();
            }
            DB::commit();

            session()->flash('success', 'Barang berhasil dihapus!');
            $this->loadPenawaran();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menghapus: ' . $e->getMessage());
        }
    }

    public function cancelEdit()
    {
        $this->edit_id = null;
        $this->items = [['nama_barang' => '', 'spesifikasi' => '', 'jumlah' => '']];
        $this->selected_vendors = [];
        $this->loadPenawaran();
    }

    public function render()
    {
        return view('livewire.procurement.tambah-barang')
            ->layoutData([
                'headerTitle' => 'Tambah Barang',
                'backUrl' => route('procurement-batch_barang')
            ]);
    }
}
