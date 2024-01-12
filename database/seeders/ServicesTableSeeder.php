<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Wi-Fi'],
            ['name' => 'Piscina'],
            ['name' => 'Parcheggio gratuito'],
            ['name' => 'Vasca'],
            ['name' => 'Lavatrice'],
            ['name' => 'Self check-in'],
            ['name' => 'TV'],
            ['name' => 'Animali ammessi'],
            ['name' => 'Palestra'],
            ['name' => 'Aria condizionata'],
            ['name' => 'Ascensore'],
            ['name' => 'Accessibilità per disabili'],
            ['name' => 'Giardino'],
            ['name' => 'Balcone'],
            ['name' => 'Asciugacapelli'],
            ['name' => 'Cucina attrezzata'],
            ['name' => 'Accesso alla spiaggia'],
            ['name' => 'Vista mare'],
            ['name' => 'Acqua calda'],
            ['name' => 'Ferro da stiro'],
        ];

        foreach ($data as $sponsorData) {
            Service::create($sponsorData);
        }
    }
}
