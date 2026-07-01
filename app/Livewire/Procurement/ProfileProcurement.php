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
    public $username;

    // Password properties
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->username = $user->username;
        $procurement = $user->procurement;
        if ($procurement) {
            $this->nama_procurement = $procurement->nama_procurement;
            $this->email = $procurement->email;
            $this->no_hp = $procurement->no_hp;
        }
    }

    public function updateProfile()
    {
        $user = Auth::user();
        $this->validate([
            'nama_procurement' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'username' => 'required|string|max:100|unique:akun,username,' . $user->id_akun . ',id_akun',
        ], [
            'username.unique' => 'Username ini sudah digunakan oleh pengguna lain.',
        ]);

        $procurement = $user->procurement;
        if ($procurement) {
            $procurement->update([
                'nama_procurement' => $this->nama_procurement,
                'email' => $this->email,
                'no_hp' => \App\Models\User::normalizePhone($this->no_hp),
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
            
            session()->flash('success', 'Profile berhasil diperbarui!');
            $this->dispatch('profile-updated');
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
