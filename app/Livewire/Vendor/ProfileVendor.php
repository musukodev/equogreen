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
    public $username;

    // Password properties
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->username = $user->username;
        $vendor = $user->vendor;
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
        $user = Auth::user();
        $this->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email_perusahaan' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'penanggung_jawab' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'username' => 'required|string|max:100|unique:akun,username,' . $user->id_akun . ',id_akun',
        ], [
            'username.unique' => 'Username ini sudah digunakan oleh pengguna lain.',
        ]);

        $vendor = $user->vendor;
        if ($vendor) {
            $vendor->update([
                'nama_perusahaan' => $this->nama_perusahaan,
                'email_perusahaan' => $this->email_perusahaan,
                'no_hp' => \App\Models\User::normalizePhone($this->no_hp),
                'alamat' => $this->alamat,
                'penanggung_jawab' => $this->penanggung_jawab,
                'deskripsi' => $this->deskripsi,
            ]);

            $user->update([
                'username' => $this->username
            ]);

            // Ubah password jika diisi
            if (!empty($this->current_password) || !empty($this->new_password) || !empty($this->new_password_confirmation)) {
                $this->validate([
                    'current_password' => 'required',
                    'new_password' => 'required|string|min:6|confirmed',
                ], [
                    'current_password.required' => 'Password lama wajib diisi.',
                    'new_password.required' => 'Password baru wajib diisi.',
                    'new_password.min' => 'Password baru minimal terdiri dari 6 karakter.',
                    'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
                ]);

                $user = Auth::user();
                if (!\Illuminate\Support\Facades\Hash::check($this->current_password, $user->password)) {
                    $this->addError('current_password', 'Password lama yang Anda masukkan salah.');
                    return;
                }

                $user->update([
                    'password' => \Illuminate\Support\Facades\Hash::make($this->new_password)
                ]);

                $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
            }

            session()->flash('success', 'Profile vendor berhasil diperbarui!');
            $this->dispatch('profile-updated');
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
