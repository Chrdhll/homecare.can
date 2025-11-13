<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Booster Complex
        Service::create([
            'name' => 'Booster Complex',
            'description' => 'Contains : Vitamin B1, B6, B12',
            'benefits' => "Meningkatkan energi dan stamina.\nMendukung fungsi sistem saraf.\nMembantu metabolisme tubuh.",
            'price' => 150000,
            'image' => 'service-images/default-service.png', // Path di dalam storage/app/public/
        ]);

        // 2. Booster Vitamin C
        Service::create([
            'name' => 'Booster Vitamin C',
            'description' => 'Contains : Vitamin C 1000 mg',
            'benefits' => "Meningkatkan daya tahan tubuh.\nSebagai antioksidan kuat.\nMembantu mencerahkan kulit.",
            'price' => 200000,
            'image' => 'service-images/default-service.png',
        ]);

        // 3. Combo Booster
        Service::create([
            'name' => 'Combo Booster',
            'description' => 'Contains : Vitamin B1, B6, B12, Vitamin C 1000 mg',
            'benefits' => "Paket lengkap untuk imunitas dan energi.\nMendukung pemulihan pasca sakit.",
            'price' => 300000,
            'image' => 'service-images/default-service.png',
        ]);

        // 4. Immune Booster Plus
        Service::create([
            'name' => 'Immune Booster Plus',
            'description' => 'Contains : Vitamin B1, B2, B3, B5, B6, B7, B9, B12, Vitamin C',
            'benefits' => "Kombinasi Vitamin B Kompleks dan C dosis tinggi.\nSangat baik untuk yang aktivitas tinggi.",
            'price' => 400000,
            'image' => 'service-images/default-service.png',
        ]);

        // 5. Immune Booster Premium
        Service::create([
            'name' => 'Immune Booster Premium',
            'description' => 'Contains : Vitamin A, B Complex, C, D3, E',
            'benefits' => "Dilengkapi Vitamin A, D, dan E.\nMenjaga kesehatan mata, tulang, dan kulit.\nImunitas super lengkap.",
            'price' => 500000,
            'image' => 'service-images/default-service.png',
        ]);

        // 6. Immune Booster Platinum
        Service::create([
            'name' => 'Immune Booster Platinum',
            'description' => 'Contains : Vitamin A, B Complex, C, D3, E, Asam Amino, dll.',
            'benefits' => "Paket paling lengkap dengan Asam Amino.\nMempercepat regenerasi sel.\nUltimate booster untuk tubuh.",
            'price' => 700000,
            'image' => 'service-images/default-service.png',
        ]);
    }
}
