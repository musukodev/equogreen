<?php

namespace App\Livewire\Procurement;

use App\Models\Batch;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Batch Barang - Equogreen')]
class BatchList extends Component
{
    public $showModal = false;
    public $newYear = '';
    public $search = '';

    public function mount()
    {
        if (Batch::count() == 0) {
            return redirect()->route('procurement-batch_barang');
        }
    }

    public function addFolder()
    {
        $this->validate([
            'newYear' => 'required|numeric|min:2000|max:2100'
        ]);

        return redirect()->route('procurement-batch_barang');
    }

    public function render()
    {
        $query = Batch::select(DB::raw('YEAR(waktu_mulai) as year'))->distinct();

        if ($this->search) {
            $query->having('year', 'like', '%' . $this->search . '%');
        }

        $years = $query->orderBy('year', 'desc')->pluck('year');

        return view('livewire.procurement.batch-list', [
            'years' => $years
        ])->layoutData([
            'headerTitle' => 'Batch Barang',
            'headerDescription' => 'Silahkan akses folder sesuai tahun yang diinginkan'
        ]);
    }
}
