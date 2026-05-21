<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Procurement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

  
    public function run(): void
{
    
    Procurement::create([
        'nama_procurement'     => 'Admin Procurement',
        'email_procurement'    => 'procurement@gmail.com',
        'no_hp'               => '081234567890',
    ]);

    User::factory()->create([
        'name'     => 'Admin Procurement',
        'email'    => 'procurement@gmail.com',
        'password' => bcrypt('password'),
        'role'     => 'procurement',
        'procurement_id' => Procurement::where('email_procurement', 'procurement@gmail.com')->first()->id,
    ]);
}
}
