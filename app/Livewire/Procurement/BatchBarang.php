<?php

namespace App\Livewire\Procurement;

use App\Models\Batch;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Batch Barang - Equogreen')]
class BatchBarang extends Component
{
    public $year;
    public $showModal = false;
    public $showSuccessModal = false;
    public $successMessage = '';
    public $editMode = false;
    public $editingId = null;

    // Form inputs
    public $start_date;
    public $start_time;
    public $end_date;
    public $end_time;
    public $id_procurement_terpilih = null;
    
    public $procurementList = [];

    public function mount()
    {
        // Muat daftar procurement jika yang login adalah Superadmin
        if (Auth::user()->role === 'Superadmin') {
            $this->procurementList = \App\Models\Procurement::all();
        }
    }

    public function openAddModal()
    {
        $this->reset(['start_date', 'start_time', 'end_date', 'end_time', 'id_procurement_terpilih', 'editingId']);
        $this->resetValidation();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function editBatch($id)
    {
        $this->resetValidation();
        $this->editingId = $id;
        $batch = Batch::findOrFail($id);

        $this->start_date = date('Y-m-d', strtotime($batch->waktu_mulai));
        $this->start_time = date('H:i', strtotime($batch->waktu_mulai));
        $this->end_date = date('Y-m-d', strtotime($batch->waktu_selesai));
        $this->end_time = date('H:i', strtotime($batch->waktu_selesai));
        $this->id_procurement_terpilih = $batch->id_procurement;

        $this->editMode = true;
        $this->showModal = true;
    }

    public function store()
    {
        $rules = [
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date'   => 'required|date',
            'end_time'   => 'required',
        ];

        // Jika superadmin, wajib memilih procurement tujuan
        if (Auth::user()->role === 'Superadmin') {
            $rules['id_procurement_terpilih'] = 'required|integer';
        }

        $this->validate($rules, [
            'id_procurement_terpilih.required' => 'Wajib memilih admin procurement tujuan untuk batch ini.'
        ]);

        $waktu_mulai = $this->start_date . ' ' . $this->start_time . ':00';
        $waktu_selesai = $this->end_date . ' ' . $this->end_time . ':00';

        // Additional validation: Ensure end time is after start time
        if (strtotime($waktu_selesai) <= strtotime($waktu_mulai)) {
            $this->addError('end_date', 'Waktu selesai harus lebih lambat dari waktu mulai.');
            return;
        }

        if ($this->editMode) {
            $batch = Batch::findOrFail($this->editingId);
            $id_proc = Auth::user()->role === 'Superadmin' 
                ? $this->id_procurement_terpilih 
                : Auth::user()->id_procurement;

            $batch->update([
                'id_procurement' => $id_proc,
                'waktu_mulai'    => $waktu_mulai,
                'waktu_selesai'  => $waktu_selesai,
            ]);

            $this->successMessage = 'Batch berhasil diperbarui.';
        } else {
            $id_proc = Auth::user()->role === 'Superadmin' 
                ? $this->id_procurement_terpilih 
                : Auth::user()->id_procurement;

            Batch::create([
                'id_procurement' => $id_proc,
                'waktu_mulai'    => $waktu_mulai,
                'waktu_selesai'  => $waktu_selesai,
            ]);

            $this->successMessage = 'Batch berhasil ditambahkan.';
        }

        $this->showModal = false;

        // Reset form
        $this->start_date = null;
        $this->start_time = null;
        $this->end_date = null;
        $this->end_time = null;
        $this->id_procurement_terpilih = null;
        $this->editingId = null;

        $this->showSuccessModal = true;
    }

    public function deleteBatch($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        $this->successMessage = 'Batch berhasil dihapus.';
        $this->showSuccessModal = true;
    }

    public function render()
    {
        $layoutData = [
            'headerTitle' => 'Batch Barang',
            'headerDescription' => 'Silakan akses folder sesuai tahun yang diinginkan'
        ];

        $user = Auth::user();

        // 1. Dapatkan query dasar batch dengan relasi penawaran
        $query = Batch::with('penawaran');

        // 2. Jika bukan Superadmin, batasi hanya melihat batch buatannya sendiri
        if ($user->role !== 'Superadmin') {
            $query->where('id_procurement', $user->id_procurement);
        }

        $batches = $query->orderBy('waktu_mulai', 'asc')->get();

        if ($batches->isEmpty()) {
            return view('livewire.procurement.batch-barang-item-kosong', [
                'batches' => []
            ])->layoutData($layoutData);
        }

        return view('livewire.procurement.batch-barang', [
            'batches' => $batches
        ])->layoutData($layoutData);
    }
}
