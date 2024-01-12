<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            [
                'name' => 'Mario',
                'lastname' => 'Rossi',
                'email' => 'mario.rossi@example.com',
                'password' => Hash::make('password123'),
                'date_of_birth' => '1990-05-15',
                'phone_number' => '+1234567890',
            ],
            [
                'name' => 'Anna',
                'lastname' => 'Bianchi',
                'email' => 'anna.bianchi@example.com',
                'password' => Hash::make('password456'),
                'date_of_birth' => '1985-08-22',
                'phone_number' => '+9876543210',
            ],
            [
                'name' => 'Luca',
                'lastname' => 'Verdi',
                'email' => 'luca.verdi@example.com',
                'password' => Hash::make('password789'),
                'date_of_birth' => '1995-02-10',
                'phone_number' => '+1122334455',
            ],
            [
                'name' => 'Giovanna',
                'lastname' => 'Gallo',
                'email' => 'giovanna.gallo@example.com',
                'password' => Hash::make('passwordabc'),
                'date_of_birth' => '1980-11-28',
                'phone_number' => '+9988776655',
            ],
            [
                'name' => 'Marco',
                'lastname' => 'Ferrari',
                'email' => 'marco.ferrari@example.com',
                'password' => Hash::make('passwordxyz'),
                'date_of_birth' => '1993-07-05',
                'phone_number' => '+1122334455',
            ],
        ];

        foreach ($usersData as $user) {
            User::create($user);
        }
    }
}
