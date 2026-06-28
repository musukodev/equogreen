<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Procurement;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
        // 1. Seed Superadmin Account
        $superadminProcurement = Procurement::create([
            'nama_procurement' => 'Fawwaz Procurement Ecogreen',
            'email'            => 'tutor.programing12@gmail.com',
            'no_hp'            => '6281234567890',
        ]);

        User::create([
            'username'       => 'superadmin',
            'password'       => bcrypt('password'),
            'role'           => 'Superadmin',
            'id_procurement' => $superadminProcurement->id_procurement,
        ]);

        // 2. Seed Regular Admin Procurement Account
        $procurement = Procurement::create([
            'nama_procurement' => 'Naufal Procurement Ecogreen',
            'email'            => 'shinon99999777@gmail.com',
            'no_hp'            => '6280987654321',
        ]);

        User::create([
            'username'       => 'admin_procurement',
            'password'       => bcrypt('password'),
            'role'           => 'Procurement',
            'id_procurement' => $procurement->id_procurement,
        ]);

        $this->call(VendorSeeder::class);
    }
}
