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

    // Form inputs
    public $start_date;
    public $start_time;
    public $end_date;
    public $end_time;

    public function mount()
    {
        // No year filter needed
    }

    public function store()
    {
        $this->validate([
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date'   => 'required|date',
            'end_time'   => 'required',
        ]);

        $waktu_mulai = $this->start_date . ' ' . $this->start_time . ':00';
        $waktu_selesai = $this->end_date . ' ' . $this->end_time . ':00';

        // Additional validation: Ensure end time is after start time
        if (strtotime($waktu_selesai) <= strtotime($waktu_mulai)) {
            $this->addError('end_date', 'Waktu selesai harus lebih lambat dari waktu mulai.');
            return;
        }

        Batch::create([
            'id_procurement' => Auth::user()->id_procurement,
            'waktu_mulai'    => $waktu_mulai,
            'waktu_selesai'  => $waktu_selesai,
        ]);

        $this->showModal = false;

        // Reset form
        $this->start_date = null;
        $this->start_time = null;
        $this->end_date = null;
        $this->end_time = null;

        $this->successMessage = 'Batch berhasil ditambahkan.';
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
        if (Batch::count() == 0) {
            return view('livewire.procurement.batch-barang-item-kosong', [
                'batches' => []
            ]);
        }

        $batches = Batch::with('penawaran')
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        return view('livewire.procurement.batch-barang', [
            'batches' => $batches
        ]);
    }
}
