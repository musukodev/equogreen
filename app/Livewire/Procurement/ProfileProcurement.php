<?php

namespace App\Livewire\Procurement;

use App\Models\Procurement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Profile - Equogreen')]
class ProfileProcurement extends Component
{
    public $nama_procurement;
    public $email;
    public $no_hp;

    public function mount()
    {
        $procurement = Auth::user()->procurement;
        if ($procurement) {
            $this->nama_procurement = $procurement->nama_procurement;
            $this->email = $procurement->email;
            $this->no_hp = $procurement->no_hp;
        }
    }

    public function updateProfile()
    {
        $this->validate([
            'nama_procurement' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        $procurement = Auth::user()->procurement;
        if ($procurement) {
            $procurement->update([
                'nama_procurement' => $this->nama_procurement,
                'email' => $this->email,
                'no_hp' => $this->no_hp,
            ]);
            
            session()->flash('success', 'Profile berhasil diperbarui!');
        } else {
            session()->flash('error', 'Data Procurement tidak ditemukan.');
        }
    }

    public function render()
    {
        return view('livewire.procurement.profile-procurement')
            ->layoutData([
                'headerTitle' => 'Profile',
                'headerDescription' => 'Silakan ubah data profile apabila ada perubahan'
            ]);
    }
}
