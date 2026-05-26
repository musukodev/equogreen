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

    public function mount($batch_id)
    {
        $this->batch_id = $batch_id;
        $this->loadVendors();
    }

    public function updatedKategoriTerpilih()
    {
        $this->selected_vendors = [];
        $this->loadVendors();
    }

    public function loadVendors()
    {
        // Adjust the query depending on how the categories are saved in the DB
        // The UI has: atk, elektronik, furniture, cleaning
        $this->vendors = Vendor::where('status', 'approved')
            ->where('kategori_vendor', $this->kategori_terpilih)
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
        // Validasi
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
            DB::commit();

            session()->flash('success', 'Barang berhasil ditambahkan dan penawaran dikirim ke vendor!');
            return redirect()->route('procurement-batch_barang_empty');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.procurement.tambah-barang');
    }
}
