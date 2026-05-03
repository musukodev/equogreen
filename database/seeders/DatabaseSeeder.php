<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

  
    public function run(): void
{
    
    User::factory()->create([
        'name'     => 'Admin Procurement',
        'email'    => 'procurement@gmail.com',
        'password' => bcrypt('password'),
        'role'     => 'procurement',
    ]);

    User::factory()->create([
        'name'     => 'Vendor Satu',
        'email'    => 'vendor@gmail.com',
        'password' => bcrypt('password'),
        'role'     => 'vendor',
    ]);
}
}
