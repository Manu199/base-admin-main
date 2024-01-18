<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => '24 ore di sponsorizzazione', 'description' => 'Sponsorizzazione per 24 ore', 'price' => 2.99, 'duration' => 24],
            ['name' => '72 ore di sponsorizzazione', 'description' => 'Sponsorizzazione per 72 ore', 'price' => 5.99, 'duration' => 72],
            ['name' => '144 ore di sponsorizzazione', 'description' => 'Sponsorizzazione per 144 ore', 'price' => 9.99, 'duration' => 144],
        ];

        foreach ($data as $sponsorData) {
            Sponsor::create($sponsorData);
        }
    }
}
