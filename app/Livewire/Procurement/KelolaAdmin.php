<?php

namespace App\Livewire\Procurement;

use App\Models\User;
use App\Models\Procurement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Kelola Admin - Equogreen')]
class KelolaAdmin extends Component
{
    public $showModal = false;
    public $editMode = false;
    public $editingId = null;

    // Form inputs
    public $nama_procurement;
    public $email;
    public $no_hp;
    public $username;
    public $password;

    public function mount()
    {
        // Proteksi di tingkat Livewire component
        if (Auth::user()->role !== 'Superadmin') {
            abort(403, 'Akses ditolak. Hanya Superadmin yang diizinkan mengelola akun.');
        }
    }

    public function openAddModal()
    {
        $this->reset(['nama_procurement', 'email', 'no_hp', 'username', 'password', 'editingId']);
        $this->editMode = false;
        $this->showModal = true;
    }

    public function editAdmin($idProcurement)
    {
        $this->resetValidation();
        $this->editingId = $idProcurement;
        $procurement = Procurement::findOrFail($idProcurement);
        $user = User::where('id_procurement', $idProcurement)->first();

        $this->nama_procurement = $procurement->nama_procurement;
        $this->email = $procurement->email;
        $this->no_hp = $procurement->no_hp;
        $this->username = $user ? $user->username : '';
        $this->password = ''; // Kosongkan password untuk keamanan (opsional diubah)

        $this->editMode = true;
        $this->showModal = true;
    }

    public function store()
    {
        if ($this->editMode) {
            $user = User::where('id_procurement', $this->editingId)->first();
            $idAkun = $user ? $user->id_akun : 0;

            $this->validate([
                'nama_procurement' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:procurement,email,' . $this->editingId . ',id_procurement',
                'no_hp' => 'required|string|max:20',
                'username' => 'required|string|max:100|unique:akun,username,' . $idAkun . ',id_akun',
                'password' => 'nullable|string|min:6',
            ], [
                'nama_procurement.required' => 'Nama lengkap wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.unique' => 'Email sudah terdaftar.',
                'no_hp.required' => 'No. Handphone wajib diisi.',
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan.',
                'password.min' => 'Password minimal terdiri dari 6 karakter.',
            ]);

            DB::beginTransaction();
            try {
                // Update Procurement
                $procurement = Procurement::findOrFail($this->editingId);
                $procurement->update([
                    'nama_procurement' => $this->nama_procurement,
                    'email' => $this->email,
                    'no_hp' => \App\Models\User::normalizePhone($this->no_hp),
                ]);

                // Update Akun
                if ($user) {
                    $userData = ['username' => $this->username];
                    if (!empty($this->password)) {
                        $userData['password'] = Hash::make($this->password);
                    }
                    $user->update($userData);
                }

                DB::commit();

                // Kirim email notifikasi pembaruan profile ke admin terkait
                if ($procurement->email) {
                    \Illuminate\Support\Facades\Mail::to($procurement->email)->send(
                        new \App\Mail\AdminProfileUpdatedMail($procurement, $this->username, $this->password)
                    );
                }

                // Simpan notifikasi in-app untuk admin terkait
                \App\Models\Pengumuman::create([
                    'id_vendor' => null,
                    'id_procurement' => $procurement->id_procurement,
                    'isi' => "Informasi profil akun Anda telah diperbarui oleh Superadmin."
                ]);

                // Reset forms
                $this->reset(['nama_procurement', 'email', 'no_hp', 'username', 'password', 'editingId']);
                $this->showModal = false;

                session()->flash('success', 'Akun procurement berhasil diperbarui!');
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('error', 'Gagal memperbarui admin: ' . $e->getMessage());
            }
        } else {
            $this->validate([
                'nama_procurement' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:procurement,email',
                'no_hp' => 'required|string|max:20',
                'username' => 'required|string|max:100|unique:akun,username',
                'password' => 'required|string|min:6',
            ], [
                'nama_procurement.required' => 'Nama lengkap wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.unique' => 'Email sudah terdaftar.',
                'no_hp.required' => 'No. Handphone wajib diisi.',
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal terdiri dari 6 karakter.',
            ]);

            DB::beginTransaction();
            try {
                // 1. Buat data Procurement
                $procurement = Procurement::create([
                    'nama_procurement' => $this->nama_procurement,
                    'email' => $this->email,
                    'no_hp' => \App\Models\User::normalizePhone($this->no_hp),
                ]);

                // 2. Buat data Akun (User) dengan role 'Procurement'
                $user = User::create([
                    'username' => $this->username,
                    'password' => Hash::make($this->password),
                    'role' => 'Procurement',
                    'id_procurement' => $procurement->id_procurement,
                ]);

            DB::commit();

            // 3. Kirim email selamat datang berisi username & password ke admin baru
            if ($procurement->email) {
                \Illuminate\Support\Facades\Mail::to($procurement->email)->send(
                    new \App\Mail\NewAdminWelcomeMail($procurement, $this->username, $this->password)
                );
            }

            // 4. Simpan notifikasi in-app untuk admin baru
            \App\Models\Pengumuman::create([
                'id_vendor' => null,
                'id_procurement' => $procurement->id_procurement,
                'isi' => "Selamat datang di Equogreen! Akun procurement Anda telah berhasil dibuat oleh Superadmin dengan username: " . $this->username
            ]);

            // Reset forms
                $this->reset(['nama_procurement', 'email', 'no_hp', 'username', 'password']);
                $this->showModal = false;

                session()->flash('success', 'Akun procurement baru berhasil didaftarkan!');
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('error', 'Gagal mendaftarkan admin: ' . $e->getMessage());
            }
        }
    }

    public function deleteAdmin($idProcurement)
    {
        // Proteksi: Superadmin tidak boleh menghapus dirinya sendiri
        $currentUser = Auth::user();
        if ($currentUser->id_procurement == $idProcurement) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        DB::beginTransaction();
        try {
            // Hapus data procurement (karena foreign key cascading onDelete('cascade'), akun user terkait akan otomatis terhapus)
            $procurement = Procurement::findOrFail($idProcurement);
            $procurement->delete();

            DB::commit();
            session()->flash('success', 'Akun procurement berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menghapus admin: ' . $e->getMessage());
        }
    }

    public function render()
    {
        // Tampilkan semua data procurement/admin, kecualikan yang login (Superadmin)
        $admins = User::with('procurement')
            ->where('role', 'Procurement')
            ->get();

        return view('livewire.procurement.kelola-admin', compact('admins'))
            ->layoutData([
                'headerTitle' => 'Kelola Admin',
                'headerDescription' => 'Kelola data dan buat akun procurement yang lain'
            ]);
    }
}
