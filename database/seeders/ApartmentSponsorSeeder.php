<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Sponsor;
use Illuminate\Support\Facades\DB;

class ApartmentSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorApartmentData = [
            [
                'sponsor_id' => 1,
                'apartment_id' => 1,
                'expiration_date' => '2023-01-18 14:30:00',
            ],
            [
                'sponsor_id' => 2,
                'apartment_id' => 7,
                'expiration_date' => '2024-02-05 08:45:00',
            ],
            [
                'sponsor_id' => 3,
                'apartment_id' => 9,
                'expiration_date' => '2024-03-12 18:15:00',
            ],
            [
                'sponsor_id' => 2,
                'apartment_id' => 4,
                'expiration_date' => '2024-04-20 12:00:00',
            ],
        ];


        // foreach ($dataArray as $apartmentSponsor) {
        //     $apartment = Apartment::id($apartmentSponsor['apartment_id']);
        //     $sponsor = Sponsor::id($apartmentSponsor['sponsor_id']);

        //     if ($apartment && $sponsor) {
        //         $apartment->sponsors()->attach($sponsor, ['expiration_date' => $apartmentSponsor['expiration_date']]);
        //     }
        // }


        // foreach ($sponsorApartmentData as $data) {
        //     $apartment = Apartment::find($data['apartment_id']);
        //     $sponsor = Sponsor::find($data['sponsor_id']);

        //     if ($apartment && $sponsor) {
        //         SponsorApartment::create([
        //             'apartment_id' => $apartment->id,
        //             'sponsor_id' => $sponsor->id,
        //             'expiration_date' => $data['expiration_date'],
        //         ]);
        //     }
        // }
    }
}
