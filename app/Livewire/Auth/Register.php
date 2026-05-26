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
            'kategori_vendor' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'portofolio' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = [
            'nama_perusahaan' => $this->nama_perusahaan,
            'email_perusahaan' => $this->email_perusahaan,
            'no_hp' => $this->no_hp,
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

        Vendor::create($data);

        session()->flash('success', 'Vendor berhasil didaftarkan!');
        return redirect()->route('registrasi');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
