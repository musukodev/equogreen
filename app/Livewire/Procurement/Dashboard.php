<?php

namespace App\Livewire\Procurement;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Vendor;
use App\Models\Pengumuman;
use App\Mail\VendorAnnouncementMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

#[Layout('components.layouts.app')]
#[Title('Dashboard Procurement - Equogreen')]
class Dashboard extends Component
{
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
        // Ambil kategori dari database secara dinamis berdasarkan kategori_vendor yang terdaftar pada vendor approved
        $categories = Vendor::where('status', 'approved')
            ->whereNotNull('kategori_vendor')
            ->where('kategori_vendor', '!=', '')
            ->distinct()
            ->pluck('kategori_vendor')
            ->toArray();

        // Jika kosong (misal belum ada vendor yang approved), kita bisa tampilkan fallback/default
        if (empty($categories)) {
            $categories = [
                'ATK',
                'Perangkat Lunak',
                'APD',
                'Generator Set',
                'Elektronik',
                'Pantry',
                'Kemasan',
                'Plumbing Set',
                'Furniture',
                'Alat Komunikasi',
                'Peralatan Lab',
                'Papan Informasi',
                'Kesehatan',
                'Suku Cadang',
                'Keamanan Fisik',
                'Kendaraan Logistik',
                'Mesin Produksi',
                'Bahan Penolong',
                'Pemadam Api',
                'K. Operasional',
                'Perangkat IT',
                'Bahan Baku Utama',
                'Perangkat Listrik',
                'Seragam Karyawan'
            ];
        } else {
            sort($categories);
        }

        // Hitung statistik dashboard
        $totalVendorApproved = Vendor::where('status', 'approved')->count();
        $totalVendorPending = Vendor::where('status', 'pending')->count();
        $totalBatchAktif = \App\Models\Batch::where('waktu_selesai', '>', now())->count();
        $totalNilaiPO = \App\Models\Quotation::sum(DB::raw('qty * net_price'));

        $user = Auth::user();
        $namaProcurement = $user->procurement?->nama_procurement ?? 'Procurement';

        return view('livewire.procurement.dashboard', [
            'categories' => $categories,
            'totalVendorApproved' => $totalVendorApproved,
            'totalVendorPending' => $totalVendorPending,
            'totalBatchAktif' => $totalBatchAktif,
            'totalNilaiPO' => $totalNilaiPO
        ])->layoutData([
            'headerTitle' => 'Dashboard',
            'headerDescription' => 'Halo, ' . $namaProcurement . '! Selamat datang di website Equogreen'
        ]);
    }
}
