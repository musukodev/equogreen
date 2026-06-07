<?php

namespace App\Livewire\Procurement;

use App\Models\Batch;
use App\Models\Penawaran;
use App\Models\PenawaranVendor;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
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
            ->get();
    }

    public function loadPenawaran()
    {
        $this->savedPenawaran = Penawaran::with('penawaranVendors.vendor')
            ->where('id_batch', $this->batch_id)
            ->get();
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
                $penawaran = Penawaran::findOrFail($this->edit_id);
                $penawaran->update([
                    'nama_barang' => $this->items[0]['nama_barang'],
                    'spesifikasi' => $this->items[0]['spesifikasi'],
                    'jumlah' => $this->items[0]['jumlah'],
                ]);

                // Hapus vendor lama
                PenawaranVendor::where('id_penawaran', $this->edit_id)->delete();

                foreach ($this->selected_vendors as $vendorId) {
                    PenawaranVendor::create([
                        'id_penawaran' => $penawaran->id_penawaran,
                        'id_vendor' => $vendorId
                    ]);
                }

                session()->flash('success', 'Barang berhasil diupdate!');
                $this->edit_id = null;
            } else {
                // Insert mode
                foreach ($this->items as $item) {
                    $penawaran = Penawaran::create([
                        'id_batch' => $this->batch_id,
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

    public function editPenawaran($id)
    {
        $penawaran = Penawaran::with('penawaranVendors')->findOrFail($id);
        $this->edit_id = $id;

        $this->items = [
            [
                'nama_barang' => $penawaran->nama_barang,
                'spesifikasi' => $penawaran->spesifikasi,
                'jumlah' => $penawaran->jumlah
            ]
        ];

        // Ambil vendor terpilih
        $this->selected_vendors = $penawaran->penawaranVendors->pluck('id_vendor')->toArray();

        // Coba setel kategori dropdown berdasarkan salah satu vendor, asumsikan vendor dalam satu kategori yg sama
        if (count($this->selected_vendors) > 0) {
            $vendor = Vendor::find($this->selected_vendors[0]);
            if ($vendor) {
                $this->kategori_terpilih = $vendor->kategori_vendor;
                $this->loadVendors();
            }
        }
    }

    public function deletePenawaran($id)
    {
        DB::beginTransaction();
        try {
            PenawaranVendor::where('id_penawaran', $id)->delete();
            Penawaran::findOrFail($id)->delete();
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
        return view('livewire.procurement.tambah-barang');
    }
}
