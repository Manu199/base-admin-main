<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function index()
    {
        // $apartments = Apartment::with('services', 'type')
        //     ->where('visible', 1)
        //     ->get();

        $apartments = Apartment::with('services', 'type')
            ->select([
                'apartments.*',
                DB::raw("(CASE WHEN MAX(apartment_sponsor.expiration_date >= NOW()) THEN 1 ELSE 0 END) AS is_sponsored")
            ])
            ->leftJoin('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
            ->where('visible', 1)
            ->groupBy('apartments.id')
            ->orderByDesc('is_sponsored')
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
        $minRooms = $request->query('minRooms') ?? 1;
        $minBeds = $request->query('minBeds') ?? 1;
        $services = $request->query('services') ? explode(" ", $request->query('services')) : [];

        if (!$lat || !$lon || !$radius) {
            // Almeno uno dei valori obbligatori manca
            return response()->json([
                'result' => 'failed',
                'num_result' => 0,
                'data' => [],
            ]);
        }

        $circle_radius = 6371;

        // $apartments = Apartment::with('services', 'type')
        //     ->select(['apartments.*', DB::raw("($circle_radius * ACOS(COS(RADIANS($lat)) * COS(RADIANS(apartments.lat)) * COS(RADIANS(apartments.lon) - RADIANS($lon)) + SIN(RADIANS($lat)) * SIN(RADIANS(apartments.lat)))) AS distance")])
        //     ->where('visible', 1)
        //     ->where('num_of_room', '>=', $minRooms)
        //     ->where('num_of_bed', '>=', $minBeds)
        //     ->having('distance', '<', $radius)
        //     ->whereHas('services', function ($query) use ($services) {
        //         $query->whereIn('service_id', $services);
        //     }, '=', count($services))
        //     ->orderBy('distance')
        //     ->get();

        $apartments = Apartment::with('services', 'type')
            ->select([
                'apartments.*',
                DB::raw("($circle_radius * ACOS(COS(RADIANS($lat)) * COS(RADIANS(apartments.lat)) * COS(RADIANS(apartments.lon) - RADIANS($lon)) + SIN(RADIANS($lat)) * SIN(RADIANS(apartments.lat)))) AS distance"),
                DB::raw("CASE WHEN apartment_sponsor.expiration_date >= NOW() THEN 1 ELSE 0 END AS is_sponsored")
            ])
            ->leftJoin('apartment_sponsor', 'apartments.id', '=', 'apartment_sponsor.apartment_id')
            ->where('visible', 1)
            ->where('num_of_room', '>=', $minRooms)
            ->where('num_of_bed', '>=', $minBeds)
            ->whereHas('services', function ($query) use ($services) {
                $query->whereIn('service_id', $services);
            }, '=', count($services))
            ->having('distance', '<', $radius)
            ->orderByDesc('is_sponsored') // Ordina in modo decrescente per sponsorizzazione (1 = sponsorizzato, 0 = non sponsorizzato)
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

    public function getApartmentFromSlug($slug, Request $request)
    {
        $apartment = Apartment::where('slug', $slug)->with('services')->first();

        // controlle se esiste una view, nel giorno corrente, dallo stesso ip
        $existingView = View::where('apartment_id', $apartment->id)
        ->where('ip_address', $request->ip())
        ->whereDate('date', now()->toDateString())
        ->first();

        // se non esiste questa view, allora la posso aggiungere al mio db
        if(!$existingView){
            $view = [
                'apartment_id' => $apartment->id,
                'ip_address' => $request->ip(),
                'date' => now(),
            ];
            View::create($view);
        }

        $apartment->user->makeHidden(['date_of_birth', 'phone_number']);
        $apartment['image_path'] = asset('storage/uploads/' . $apartment['image_path']);
        return response()->json($apartment);
    }
}
