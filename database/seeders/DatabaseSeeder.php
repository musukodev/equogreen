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
        $procurement = Procurement::create([
            'nama_procurement' => 'Admin Procurement',
            'email'            => 'procurement@gmail.com',
            'no_hp'            => '081234567890',
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
