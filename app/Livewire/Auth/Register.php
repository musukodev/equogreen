<?php

namespace App\Livewire\Auth;

use App\Models\Vendor;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]
#[Title('Online Registration - Equogreen')]
class Register extends Component
{
    use WithFileUploads;

    public $nama_perusahaan = '';
    public $email_perusahaan = '';
    public $no_hp = '';
    public $alamat = '';
    public $kategori_vendor = '';
    public $penanggung_jawab = '';
    public $deskripsi = '';
    public $provinsi = '';
    public $kota = '';
    public $kecamatan = '';
    public $kode_pos = '';
    public $portofolio;

    public $provinces = [];
    public $cities = [];
    public $districts = [];

    public function mount()
    {
        try {
            $this->provinces = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')->json() ?? [];
        } catch (\Exception $e) {
            $this->provinces = [];
        }
    }

    public function updatedProvinsi($value)
    {
        $this->kota = '';
        $this->kecamatan = '';
        $this->districts = [];
        
        if ($value) {
            try {
                $this->cities = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$value}.json")->json() ?? [];
            } catch (\Exception $e) {
                $this->cities = [];
            }
        } else {
            $this->cities = [];
        }
    }

    public function updatedKota($value)
    {
        $this->kecamatan = '';
        
        if ($value) {
            try {
                $this->districts = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$value}.json")->json() ?? [];
            } catch (\Exception $e) {
                $this->districts = [];
            }
        } else {
            $this->districts = [];
        }
    }

    public function register()
    {
        $this->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email_perusahaan' => 'required|email|max:255|unique:vendor',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'kategori_vendor' => 'required|string|in:atk,elektronik,furniture,cleaning,supplier umum',
            'penanggung_jawab' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'portofolio' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi.',
            'email_perusahaan.required' => 'Email perusahaan wajib diisi.',
            'email_perusahaan.email' => 'Format email perusahaan tidak valid.',
            'email_perusahaan.unique' => 'Email perusahaan ini sudah terdaftar di sistem.',
            'no_hp.required' => 'Nomor handphone perusahaan wajib diisi.',
            'alamat.required' => 'Alamat perusahaan wajib diisi.',
            'kategori_vendor.required' => 'Kategori vendor wajib diisi.',
            'kategori_vendor.in' => 'Kategori vendor yang dipilih tidak valid.',
            'penanggung_jawab.required' => 'Nama penanggung jawab wajib diisi.',
            'deskripsi.required' => 'Deskripsi perusahaan wajib diisi.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'kota.required' => 'Kota/Kabupaten wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'portofolio.required' => 'Berkas portofolio perusahaan wajib diunggah.',
            'portofolio.mimes' => 'Berkas portofolio harus berupa file berformat PDF, DOC, atau DOCX.',
            'portofolio.max' => 'Ukuran berkas portofolio tidak boleh lebih dari 2 MB (2048 KB).',
        ]);

        $data = [
            'nama_perusahaan' => $this->nama_perusahaan,
            'email_perusahaan' => $this->email_perusahaan,
            'no_hp' => \App\Models\User::normalizePhone($this->no_hp),
            'alamat' => $this->alamat,
            'kategori_vendor' => $this->kategori_vendor,
            'penanggung_jawab' => $this->penanggung_jawab,
            'deskripsi' => $this->deskripsi,
            'provinsi' => $this->provinsi,
            'kota' => $this->kota,
            'kecamatan' => $this->kecamatan,
            'kode_pos' => $this->kode_pos,
        ];

        if ($this->portofolio) {
            $filename = time() . '_' . $this->portofolio->getClientOriginalName();
            $this->portofolio->storeAs('portofolio', $filename, 'public');
            $data['portofolio'] = $filename;
        }

        $vendor = Vendor::create($data);

        // 1. Kirim email konfirmasi ke vendor
        if ($vendor->email_perusahaan) {
            \Illuminate\Support\Facades\Mail::to($vendor->email_perusahaan)->send(new \App\Mail\VendorRegisteredConfirmationMail($vendor));
        }

        // 2. Kirim email alert pendaftaran vendor baru ke semua Procurement & Superadmin
        $adminEmails = \App\Models\User::whereIn('role', ['Procurement', 'Superadmin'])
            ->with('procurement')
            ->get()
            ->map(fn($user) => $user->procurement?->email)
            ->filter()
            ->unique()
            ->toArray();

        if (!empty($adminEmails)) {
            \Illuminate\Support\Facades\Mail::to($adminEmails)->send(new \App\Mail\AdminNewVendorAlertMail($vendor));
        }

        // 3. Simpan notifikasi in-app untuk semua akun Procurement & Superadmin yang aktif
        $allAdmins = \App\Models\User::whereIn('role', ['Procurement', 'Superadmin'])->get();
        foreach ($allAdmins as $admin) {
            if ($admin->id_procurement) {
                \App\Models\Pengumuman::create([
                    'id_vendor' => null,
                    'id_procurement' => $admin->id_procurement,
                    'isi' => "Vendor baru telah mendaftar: {$vendor->nama_perusahaan} (Kategori: " . strtoupper($vendor->kategori_vendor) . "). Silakan lakukan validasi."
                ]);
            }
        }

        session()->flash('success', 'Pendaftaran berhasil! Akun Anda sedang ditinjau. Mohon tunggu konfirmasi admin melalui email.');
        return redirect()->route('registrasi');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
