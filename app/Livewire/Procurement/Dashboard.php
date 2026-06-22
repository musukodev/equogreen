<?php

namespace App\Livewire\Procurement;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Vendor;
use App\Models\Pengumuman;
use App\Mail\VendorAnnouncementMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        // Simpan pesan pengumuman saja ke properti state
        $this->showPengumumanModal = false;
        session()->flash('success', 'Isi pengumuman berhasil draf/disimpan sementara! Silahkan pilih kategori lalu klik Kirim.');
    }

    public function deletePengumuman()
    {
        $this->pengumuman = '';
        $this->showPengumumanModal = false;
        session()->flash('success', 'Draf pengumuman berhasil dibersihkan!');
    }

    public function saveWaktu()
    {
        // TODO: Save to database ketika tabel setting waktu diimplementasikan
        $this->showWaktuModal = false;
        session()->flash('success', 'Pengaturan waktu berhasil disimpan!');
    }

    public function kirim()
    {
        $this->validate([
            'pengumuman' => 'required|string',
            'selectedCategories' => 'required|array|min:1'
        ], [
            'pengumuman.required' => 'Tulis pesan pengumuman terlebih dahulu dengan mengklik banner pengumuman.',
            'selectedCategories.required' => 'Pilih minimal satu kategori vendor tujuan.',
        ]);

        // Cari vendor approved yang memiliki kategori terpilih
        // Kita bandingkan secara case-insensitive
        $categoriesLower = array_map('strtolower', $this->selectedCategories);

        $vendors = Vendor::where('status', 'approved')
            ->whereIn(DB::raw('lower(kategori_vendor)'), $categoriesLower)
            ->get();

        if ($vendors->isEmpty()) {
            session()->flash('error', 'Tidak ditemukan vendor dengan status approved pada kategori yang dipilih.');
            return;
        }

        // Simpan data pengumuman ke database untuk setiap vendor
        foreach ($vendors as $vendor) {
            Pengumuman::create([
                'id_vendor' => $vendor->id_vendor,
                'isi' => $this->pengumuman,
            ]);

            // Kirim email pengumuman jika email perusahaan diisi
            if ($vendor->email_perusahaan) {
                Mail::to($vendor->email_perusahaan)->send(new VendorAnnouncementMail($vendor, $this->pengumuman));
            }
        }

        // Reset data form
        $this->pengumuman = '';
        $this->selectedCategories = [];
        
        session()->flash('success', 'Pengumuman berhasil dikirim ke ' . $vendors->count() . ' vendor terkait!');
    }

    public function render()
    {
        return view('livewire.procurement.dashboard');
    }
}
