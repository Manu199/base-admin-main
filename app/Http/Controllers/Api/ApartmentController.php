<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('services', 'type')->get();

        $apartments->makeHidden(['address', 'lat', 'lon']);

        return response()->json($apartments);
    }

    // public function getApartments($searchLat, $searchLon, $radius)
    // {
    //     $apartments = Apartment::select(
    //         'id',
    //         'lat',
    //         'lon',
    //         DB::raw('(6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(lon) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distance_in_km')
    //     )
    //         ->addSelect(DB::raw('6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(lon) - radians(?)) + sin(radians(?)) * sin(radians(lat))) AS distance_in_km_filtered'))
    //         ->where('distance_in_km_filtered', '<=', $radius)
    //         ->get();

    //     return response()->json([
    //         'result' => 'success',
    //         'data' => $apartments,
    //     ]);

        public function getApartments($lat,$lon,$radius)
    {

        $circle_radius = 6371;
        $houses = DB::select(DB::raw('SELECT *, ( '. $circle_radius .' * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lon . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance FROM houses WHERE visible=1 HAVING distance < ' . $radius . ' ORDER BY distance') );
        ;

        // foreach ($houses as $key => $house) {
        //     dd($house->services);
        //     $house['services'] = $house->services;
        // };

        return response()->json([
            'result' => 'success',
            'data' => $houses,

            // 'count' => $houses->count()
        ]);
    }
    }

    // public function getHouse($lat, $lon, $radius)
    // {
    //     $userLocation = Distance::fromLatLng($lat, $lon);

    //     $houses = House::select(
    //         '*',
    //         $userLocation->sqlSelect('latitude', 'longitude', 'distance_in_km')
    //     )
    //         ->where('visible', 1)
    //         ->having('distance_in_km', '<', $radius)
    //         ->orderBy('distance_in_km')
    //         ->get();

    //     return response()->json([
    //         'result' => 'success',
    //         'data' => $houses,
    //     ]);
    // }


