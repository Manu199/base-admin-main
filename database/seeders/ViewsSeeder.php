<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\View;
use Faker\Generator as Faker;

class ViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {
            for ($i = 0; $i < 50; $i++) {

                $date = $faker->dateTimeBetween('-1 year', 'now');

                $view = [
                    'apartment_id' => $apartment->id,
                    'ip_address' => '127.0.0.1',
                    'date' => $date,
                     ];

                View::create($view);
            }
        }
    }
}
