<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with('services', 'type')
            ->where('visible', 1)
            ->get();

        foreach ($apartments as $apartment) {
            $apartment['image_path'] = asset('storage/uploads/' . $apartment['image_path']);
        }

        $apartments->makeHidden(['address', 'lat', 'lon']);
        return response()->json([
            'result' => 'success',
            'num_result' => count($apartments),
            'data' => $apartments,
        ]);
    }

    public function getApartments(Request $request)
    {
        $lat = $request->query('lat');
        $lon = $request->query('lon');
        $radius = $request->query('radius');

        $circle_radius = 6371;

        $apartments = Apartment::with('services', 'type')
            ->select(['apartments.*', DB::raw("($circle_radius * ACOS(COS(RADIANS($lat)) * COS(RADIANS(apartments.lat)) * COS(RADIANS(apartments.lon) - RADIANS($lon)) + SIN(RADIANS($lat)) * SIN(RADIANS(apartments.lat)))) AS distance")])
            ->where('visible', 1)
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();

        foreach ($apartments as $apartment) {
            $apartment['image_path'] = asset('storage/uploads/' . $apartment['image_path']);
        }

        $apartments->makeHidden(['address', 'lat', 'lon']);

        return response()->json([
            'result' => 'success',
            'num_result' => count($apartments),
            'data' => $apartments,
        ]);
    }

    public function getApartmentsAdvanced(Request $request)
    {
        $lat = $request->query('lat');
        $lon = $request->query('lon');
        $radius = $request->query('radius');
        $minRooms = $request->query('minRooms');
        $minBeds = $request->query('minBeds');
        $services = explode(" ", $request->query('services'));

        $circle_radius = 6371;

        $apartments = Apartment::with('services', 'type')
            ->select(['apartments.*', DB::raw("($circle_radius * ACOS(COS(RADIANS($lat)) * COS(RADIANS(apartments.lat)) * COS(RADIANS(apartments.lon) - RADIANS($lon)) + SIN(RADIANS($lat)) * SIN(RADIANS(apartments.lat)))) AS distance")])
            ->where('visible', 1)
            ->where('num_of_room', '>=', $minRooms)
            ->where('num_of_bed', '>=', $minBeds)
            ->having('distance', '<', $radius)
            ->whereHas('services', function ($query) use ($services) {
                $query->whereIn('service_id', $services);
            }, '=', count($services))
            ->orderBy('distance')
            ->get();

        foreach ($apartments as $apartment) {
            $apartment['image_path'] = asset('storage/uploads/' . $apartment['image_path']);
        }

        $apartments->makeHidden(['address', 'lat', 'lon']);

        return response()->json([
            'result' => 'success',
            'num_result' => count($apartments),
            'data' => $apartments,
        ]);
    }

    public function getAllServices()
    {
        $services = Service::all();

        return response()->json([
            'result' => 'success',
            'num_result' => count($services),
            'data' => $services,
        ]);
    }

    public function getApartment($slug)
    {
        $apartment = Apartment::where('slug', $slug)->with('services')->first();

        if ($apartment['image_path']) {

            $apartment['image_path'] = asset('storage/uploads/' . $apartment['image_path']);
        } else {

            $apartment['image_path'] = 'https://via.placeholder.com/200x200';
        }

        return response()->json($apartment);
    }
}
