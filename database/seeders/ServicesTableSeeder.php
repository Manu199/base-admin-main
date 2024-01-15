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
            ['name' => '<i class="fa-solid fa-wifi"></i>&nbsp; Wi-Fi'],
            ['name' => '<i class="fa-solid fa-person-swimming"></i>&nbsp;Piscina'],
            ['name' => '<i class="fa-solid fa-square-parking"></i>&nbsp; Parcheggio gratuito'],
            ['name' => '<i class="fa-solid fa-bath"></i>&nbsp;Vasca'],
            ['name' => '<i class="fa-solid fa-soap"></i>&nbsp;Lavatrice'],
            ['name' => '<i class="fa-solid fa-key"></i>&nbspSelf check-in'],
            ['name' => '<i class="fa-solid fa-tv"></i>&nbspTV'],
            ['name' => '<i class="fa-solid fa-paw"></i>&nbspAnimali ammessi'],
            ['name' => '<i class="fa-solid fa-dumbbell"></i>&nbspPalestra'],
            ['name' => '<i class="fa-solid fa-fan"></i>&nbspAria condizionata'],
            ['name' => '<i class="fa-solid fa-elevator"></i>&nbspAscensore'],
            ['name' => '<i class="fa-brands fa-accessible-icon"></i>&nbspAccessibilità per disabili'],
            ['name' => '<i class="fa-brands fa-pagelines"></i>&nbspGiardino'],
            ['name' => '<i class="fa-solid fa-chair"></i>&nbspBalcone'],
            ['name' => '<i class="fa-solid fa-wind"></i>&nbspAsciugacapelli'],
            ['name' => '<i class="fa-solid fa-utensils"></i>&nbspCucina attrezzata'],
            ['name' => '<i class="fa-solid fa-umbrella-beach"></i>&nbsp Accesso alla spiaggia'],
            ['name' => '<i class="fa-solid fa-water"></i> &nbspVista mare'],
            ['name' => '<i class="fa-solid fa-shower"></i>&nbsp Acqua calda'],
            ['name' => '<i class="fa-solid fa-shirt"></i>&nbsp Ferro da stiro'],
            ['name' => '<i class="fa-solid fa-mountain"></i>&nbsp Vista montagna'],
        ];

        foreach ($data as $serviceData) {
            Service::create($serviceData);
        }
    }
}
