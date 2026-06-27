<?php

namespace App\Livewire\Vendor;

use App\Models\Vendor;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Profile Vendor - Equogreen')]
class ProfileVendor extends Component
{
    public $nama_perusahaan;
    public $email_perusahaan;
    public $no_hp;
    public $alamat;
    public $penanggung_jawab;
    public $deskripsi;

    public function mount()
    {
        $vendor = Auth::user()->vendor;
        if ($vendor) {
            $this->nama_perusahaan = $vendor->nama_perusahaan;
            $this->email_perusahaan = $vendor->email_perusahaan;
            $this->no_hp = $vendor->no_hp;
            $this->alamat = $vendor->alamat;
            $this->penanggung_jawab = $vendor->penanggung_jawab;
            $this->deskripsi = $vendor->deskripsi;
        }
    }

    public function updateProfile()
    {
        $this->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email_perusahaan' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'penanggung_jawab' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        $vendor = Auth::user()->vendor;
        if ($vendor) {
            $vendor->update([
                'nama_perusahaan' => $this->nama_perusahaan,
                'email_perusahaan' => $this->email_perusahaan,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
                'penanggung_jawab' => $this->penanggung_jawab,
                'deskripsi' => $this->deskripsi,
            ]);

            session()->flash('success', 'Profile vendor berhasil diperbarui!');
        } else {
            session()->flash('error', 'Data Vendor tidak ditemukan.');
        }
    }

    public function render()
    {
        $vendor_id = Auth::user()->vendor->id_vendor ?? null;
        $notifications = Pengumuman::where('id_vendor', $vendor_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.vendor.profile-vendor', [
            'notifications' => $notifications
        ])->layoutData([
            'headerTitle' => 'Profile',
            'headerDescription' => 'Silakan ubah data profile apabila ada perubahan'
        ]);
    }
}
