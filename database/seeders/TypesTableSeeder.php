<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Case', 'description' => 'Case unifamiliari indipendenti, ideali per chi cerca la privacy e uno spazio esterno personale. Ogni casa è autonoma e offre un\'atmosfera accogliente.'],
            ['name' => 'Appartamenti', 'description' => 'Appartamenti moderni e pratici, perfetti per chi desidera un\'abitazione in un contesto più compatto. Ideali per single o coppie che preferiscono un ambiente più gestibile.'],
            ['name' => 'Condomini', 'description' => 'Unità abitative all\'interno di edifici residenziali più grandi. Offrono una comunità di vicinato e spesso includono servizi comuni come palestra, piscina o spazi verdi condivisi.'],
            ['name' => 'Plurifamiliare', 'description' => 'Strutture che ospitano più famiglie in diverse unità abitative. Ideali per comunità più ampie o gruppi di famiglie che desiderano vivere vicine.'],
            ['name' => 'Case a schiera', 'description' => 'Case adiacenti tra loro in una fila, condividendo pareti laterali. Offrono un compromesso tra la privacy delle case unifamiliari e la compattezza degli appartamenti, creando un\'atmosfera di vicinato.'],
        ];

        foreach ($data as $sponsorData) {
            Type::create($sponsorData);
        }
    }
}
