<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat User Admin
        User::create([
            'name' => 'Admin Homecare',
            'email' => 'admin@homecare.can',
            'password' => Hash::make('12345'), 
            'role' => 'admin',
        ]);

        // Buat User Pasien
        User::create([
            'name' => 'Pasien Homecare',
            'email' => 'pasien@homecare.can',
            'password' => Hash::make('12345'), 
            'role' => 'pasien',
        ]);
    }
}