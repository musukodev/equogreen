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
        $faker = \Faker\Factory::create('id_ID');
        $categories = ['atk', 'elektronik', 'furniture', 'cleaning', 'supplier umum'];

        for ($i = 0; $i < 20; $i++) {
            $kategori = $categories[array_rand($categories)];

            $vendor = Vendor::create([
                'nama_perusahaan'  => $faker->company,
                'email_perusahaan' => $faker->unique()->companyEmail,
                'no_hp'            => $faker->numerify('08##########'),
                'alamat'           => $faker->address,
                'kategori_vendor'  => $kategori,
                'penanggung_jawab' => $faker->name,
                'deskripsi'        => $faker->paragraph,
                'provinsi'         => '21',
                'kota'             => '2171',
                'kecamatan'        => '2171061',
                'kode_pos'         => '29424',
                'status'           => 'approved',
            ]);

            User::create([
                'username' => \Illuminate\Support\Str::slug($vendor->nama_perusahaan, '-'),
                'password' => bcrypt('password'),
                'role'     => 'vendor',
                'id_vendor' => $vendor->id_vendor,
            ]);
        }
    }
}
