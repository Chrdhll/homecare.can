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
        Service::create([
            'name' => 'Immune Booster Platinum',
            'description' => 'Mengandung: Vitamin A, Vitamin B1, B2, B3, B5, B6, B7, B8, B9, B12, Vitamin C
Vitamin D3, Vitamin E, Asam Amino, Asam Gikolat, Asam Klorida, Soya Lechitin',
            'price' => 150000,
            'benefits' => 'Vit.A > Menjaga kesehatan mata, kulit.
Vit. B1 > Menjaga fungsi saraf, membantu mengubah makanan menjadi energi.
Vit. B2 > Berperan pembentukan sel darah merah, membantu menjaga kesehatan mata, kulit, sistem saraf.
Vit. B3 > Membantu menurunkan kadar kolestrol jahat dan meningkatkan kolestrol baik dalam tubuh.
Vit. B6 > Berperan dalam metabolisme protein, lemak, karbohidrat.
Vit. B7 > Menjaga kesehatan rambut, kulit, kuku dan berperan dalam fungsi saraf serta enzim tubuh.
Vit. B8 > Berperan dalam pembentukan membran sel, regulasi insulin dan fungsi neurotransmitter.
Vit. B9 > Berperan dalam pembentukan sel darah merah dan fungsi sel sehat.
Vit. B12 > Menjaga fugsi saraf dan mendukung metabolisme energi.
Vit.C > Meningkatkan kekebalan tubuh, melindungi sel dari radikal bebas.
Vit. D3 > Membantu penyerapan kalsium dan fosfor untuk kesehatan tulang dan gigi.
Vit. E > Menjaga kesehatan kulit, mata, jantung dan mengurangi risiko kanker.
As. Amino > Membantu manjaga kesehatan jantung, kulit, membantu memperbaiki jaringan yang rusak.
As. Gikolat > Membantu mengangkat sel kulit mati, merangsang pertumbuhan kulit baru.
As. Klorida > Berperan dalam sistem pencernaan seperti membantu membunuh bakteri berbahaya.
Soya Lecithin > Membantu menurunkan kadar kolestrol, menjaga kesehatan jantung, sebagai  antioksidan.
',
            'image' => 'images/default-service.png',
        ]);

        Service::create([
            'name' => 'Immune Booster Premium',
            'description' => 'Mengandung : Vitamin A, Vitamin B1, B2, B3, B5, B6, B7, B12, Vitamin C
Vitamin D3, Vitamin E',
            'price' => 250000,
            'benefits' => 'Vit.A > Menjaga kesehatan mata, kulit.
Vit. B1 > Menjaga fungsi saraf, membantu mengubah makanan menjadi energi.
Vit. B2 > Berperan pembentukan sel darah merah, kesehatan mata, kulit, sistem saraf.
Vit. B3 > Membantu menurunkan kadar kolestrol jahat dan meningkatkan kolestrol baik dalam tubuh.
Vit. B6 > Berperan dalam metabolisme protein, lemak, karbohidrat.
Vit. B7 > Menjaga kesehatan rambut, kulit, kuku dan berperan dalam fungsi saraf serta enzim tubuh.
Vit. B9 > Berperan dalam pembentukan sel darah merah dan fungsi sel sehat.
Vit. B12 > Menjaga fugsi saraf dan mendukung metabolisme energi.
Vit.C > Meningkatkan kekebalan tubuh, melindungi sel dari radikal bebas.
Vit. D3 > Membantu penyerapan kalsium dan fosfor untuk kesehatan tulang dan gigi.
Vit. E > Menjaga kesehatan kulit, mata, jantung dan mengurangi risiko kanker.',
            'image' => 'images/default-service.png',
        ]);

        Service::create([
            'name' => 'Immune Booster Plus',
            'description' => 'Mengandung : Vitamin B1, B2, B3, B5, B6, B7, B9, B12, Vitamin C',
            'price' => 120000,
            'benefits' => 'Vit. B1 > Menjaga fungsi saraf, membantu mengubah makanan menjadi energi.
Vit. B2 > Berperan pembentukan sel darah merah, kesehatan mata, kulit, sistem saraf.
Vit. B3 > Membantu menurunkan kadar kolestrol jahat dan meningkatkan kolestrol baik dalam tubuh.
Vit. B6 > Berperan dalam metabolisme protein, lemak, karbohidrat.
Vit. B7 > Menjaga kesehatan rambut, kulit, kuku dan berperan dalam fungsi saraf serta enzim tubuh.
Vit. B9 > Berperan dalam pembentukan sel darah merah dan fungsi sel sehat.
Vit. B12 > Menjaga fugsi saraf dan mendukung metabolisme energi.
Vit.C > Meningkatkan kekebalan tubuh, melindungi sel dari radikal bebas.',
            'image' => 'images/default-service.png',
        ]);
        Service::create([
            'name' => 'Combo Booster',
            'description' => 'Mengandung : Vitamin B1, B6, B12, Vitamin C 1000 mg',
            'price' => 120000,
            'benefits' => 'Sebagai anti oksidan
Meningkatkan daya tahan tubuh
Mencegah anemia
Melindungi sel dari kerusakan akibat radikal bebas
Berperan dalam menjaga kesehatan kulit, mata, gigi, tulang
Membantu penyembuhan luka
Vit. B1 > Menjaga fungsi saraf, membantu mengubah makanan menjadi energi
Vit. B6 > Berperan dalam metabolisme protein, lemak, karbohidrat
Vit. B12 > Menjaga fungsi saraf dan membantu metabolisme energi dalam tubuh',
            'image' => 'images/default-service.png',
        ]);
        Service::create([
            'name' => 'Booster Vitamin C',
            'description' => 'Mengandung : Vitamin C 1000 mg',
            'price' => 120000,
            'benefits' => 'Sebagai anti oksidan
Meningkatkan daya tahan tubuh
Mencegah anemia
Melindungi sel dari kerusakan akibat radikal bebas
Berperan dalam menjaga kesehatan kulit, mata, gigi, tulang
Membantu penyembuhan luka',
            'image' => 'images/default-service.png',
        ]);
        Service::create([
            'name' => 'Booster Complax',
            'description' => 'Mengandung : Vitamin B1, B6, B12',
            'price' => 120000,
            'benefits' => 'Sebagai anti oksidan
Meningkatkan daya tahan tubuh
Vit. B1 > Menjaga fungsi saraf, membantu mengubah makanan menjadi energi
Vit. B6 > Berperan dalam metabolisme protein, lemak, karbohidrat
Vit. B12 > Menjaga fungsi saraf dan membantu metabolisme energi dalam tubuh',
            'image' => 'images/default-service.png',
        ]);
    }
}
