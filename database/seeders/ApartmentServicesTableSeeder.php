<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Service;

class ApartmentServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $services = Service::all();

        foreach (Apartment::all() as $apartment) {
            // Num casuale di servizi da associare
            $numOfServices = rand(1, count($services));

            // Numero random servizi
            $randomServices = $services->random($numOfServices);

            // Associo i servizi all'appartamento
            $apartment->services()->attach($randomServices);
        }

    }
}
