<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Apartment;
use Faker\Generator as Faker;


class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {
            for ($i = 0; $i < 15; $i++) {
                Message::create([
                    'name' => $faker->name,
                    'email_sender' => $faker->email,
                    'text' => $faker->paragraph,
                    'date' => $faker->dateTimeBetween('-1 year', 'now'),
                    'apartment_id' => $apartment->id,
                ]);
            }
        }
    }
}
