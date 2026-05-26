<?php

namespace App\Livewire\Procurement;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Dashboard Procurement - Equogreen')]
class Dashboard extends Component
{
    public $showPengumumanModal = false;
    public $showWaktuModal = false;

    public $pengumuman = '';
    public $selectedCategories = [];

    // Waktu properties
    public $start_time;
    public $end_time;
    public $start_date;
    public $end_date;

    public function toggleCategory($category)
    {
        if (in_array($category, $this->selectedCategories)) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$category]);
        } else {
            $this->selectedCategories[] = $category;
        }
    }

    public function savePengumuman()
    {
        // TODO: Save to database when model is available
        $this->showPengumumanModal = false;
        session()->flash('success', 'Pengumuman berhasil disimpan!');
    }

    public function deletePengumuman()
    {
        $this->pengumuman = '';
        $this->showPengumumanModal = false;
        session()->flash('success', 'Pengumuman berhasil dihapus!');
    }

    public function saveWaktu()
    {
        // TODO: Save to database when model is available
        $this->showWaktuModal = false;
        session()->flash('success', 'Pengaturan waktu berhasil disimpan!');
    }

    public function kirim()
    {
        // TODO: Publish everything
        session()->flash('success', 'Berhasil dikirim!');
    }

    public function render()
    {
        return view('livewire.procurement.dashboard');
    }
}
