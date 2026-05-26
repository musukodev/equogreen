<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = Vendor::create([
            'nama_perusahaan'  => 'PT Karya Vendor Nusantara',
            'email_perusahaan' => 'vendor1@gmail.com',
            'no_hp'            => '081234567891',
            'alamat'           => 'Jl. Industri No. 1, Jakarta',
            'kategori_vendor'  => 'supplier',
            'penanggung_jawab' => 'Budi Santoso',
            'deskripsi'        => 'Menyediakan berbagai kebutuhan ATK dan kantor',
            'provinsi'         => '31',
            'kota'             => '3173',
            'kecamatan'        => '3173010',
            'kode_pos'         => '11410',
        ]);

        User::create([
            'username' => 'admin_vendor1',
            'password' => bcrypt('password'),
            'role'     => 'Vendor',
            'id_vendor'=> $vendor->id_vendor ?? $vendor->id,
        ]);
    }
}
