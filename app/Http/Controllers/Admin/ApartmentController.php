<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApartmentRequest;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Apartment - Create';
        $method = 'POST';
        $route = route('admin.apartment.store');
        $apartment = null;
        $services = Service::all();
        return view('admin.apartments.create_edit', compact('title', 'route', 'method', 'apartment', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentRequest $request)
    {
        $form_data = $request->all();
        $form_data['user_id'] = Auth::id();
        $form_data['type_id'] = 1; // debug
        $form_data['slug'] = Helper::generateSlug($form_data['title'], Apartment::class);

        // chiamata all'api tom tom
        // https://api.tomtom.com/search/2/geocode/Via Roma 33.json?key=JFycdOFju9JHTRcWGALUGaqq5FULPTe8
        $apiUrl = 'https://api.tomtom.com/search/2/geocode/';
        $apiQuery = $form_data['street_address'] . ' ' . $form_data['postal_code'] . '.json';
        $encodedAddress = urlencode($apiQuery);
        $apiKey = '?key=JFycdOFju9JHTRcWGALUGaqq5FULPTe8';

        $endpoint = $apiUrl . $encodedAddress . $apiKey;

        // Ottenere il contenuto dell'endpoint come stringa
        $data = file_get_contents($endpoint);

        // Decodifica della stringa JSON come array associativo
        $data_decode = json_decode($data, true);

        $address = $data_decode['results'][0]['address'];
        $position = $data_decode['results'][0]['position'];

        $form_data['country'] = $address['country'];
        if (!array_key_exists('streetNumber', $address)) {
            $address['streetNumber'] = 1;
        }
        $form_data['street_address'] = $address['streetName'] . ' ' . $address['streetNumber'];
        $form_data['city_name'] = $address['municipality'];

        $form_data['lat'] = $position['lat'];
        $form_data['lon'] = $position['lon'];

        // visible
        if (!array_key_exists('visible', $form_data)) {
            $form_data['visible'] = 0;
        } else {
            $form_data['visible'] = 1;
        }

        // verifico se esiste l'immagine
        if (array_key_exists('image_path', $form_data)) {
            $img_path = Storage::put('uploads', $form_data['image_path']);
            $form_data['image_path'] = basename($img_path);
        }

        $apartment = Apartment::create($form_data);

        // Attach dei servizi
        if (array_key_exists('services', $form_data)) {
            $apartment->services()->attach($form_data['services']);
        }

        return redirect()->route('admin.apartment.show', $apartment)->with('success', 'Creazione avvenuta con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        if ($apartment->user_id != Auth::id()) {
            $apartments = Apartment::where('user_id', Auth::id())->get();
            return redirect()->route('admin.apartment.index', compact('apartments'));
        }
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {

        $title = 'Apartment - Edit';
        $method = 'PUT';
        $route = route('admin.apartment.update', $apartment);
        $services = Service::all();

        return view('admin.apartments.create_edit', compact('title', 'route', 'method', 'apartment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentRequest $request, Apartment $apartment)
    {
        $form_data = $request->all();

        // se il titolo dell'appartamento cambia, cambia anche lo slug
        if ($apartment->title === $form_data['title']) {
            $form_data['slug'] = $apartment->slug;
        } else {
            $form_data['slug'] = Helper::generateSlug($form_data['title'], Apartment::class);
        }

        // se ['street_address'] ['postal_code'] sono cambiati, cambio dati di tom tom
        if ($apartment->street_address !== $form_data['street_address'] || $apartment->postal_code !== $form_data['postal_code']) {
            $apiUrl = 'https://api.tomtom.com/search/2/geocode/';
            $apiQuery = $form_data['street_address'] . ' ' . $form_data['postal_code'] . '.json';
            $encodedAddress = urlencode($apiQuery);
            $apiKey = '?key=JFycdOFju9JHTRcWGALUGaqq5FULPTe8';

            $endpoint = $apiUrl . $encodedAddress . $apiKey;

            // Ottenere il contenuto dell'endpoint come stringa
            $data = file_get_contents($endpoint);

            // Decodifica della stringa JSON come array associativo
            $data_decode = json_decode($data, true);

            $address = $data_decode['results'][0]['address'];
            $position = $data_decode['results'][0]['position'];

            $form_data['country'] = $address['country'];
            if (!array_key_exists('streetNumber', $address)) {
                $address['streetNumber'] = 1;
            }
            $form_data['street_address'] = $address['streetName'] . ' ' . $address['streetNumber'];
            $form_data['city_name'] = $address['municipality'];

            $form_data['lat'] = $position['lat'];
            $form_data['lon'] = $position['lon'];
        }

        // visible
        if (!array_key_exists('visible', $form_data)) {
            $form_data['visible'] = 0;
        } else {
            $form_data['visible'] = 1;
        }

        // controllo che nei miei dati ricevuti dal form sia stata aggiunta un'immagine
        if (array_key_exists('image_path', $form_data)) {
            if ($apartment->image_path) {
                // cancello la vecchia immmagine se esiste
                Storage::delete('uploads/' . $apartment->image_path);
            }
            // inserisco la nuova immagine
            $img_path = Storage::put('uploads', $form_data['image_path']);
            $form_data['image_path'] = basename($img_path);
        }

        $apartment->update($form_data);

        return redirect()->route('admin.apartment.show', $apartment)->with('success', 'Modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->image_path) {
            // cancello la vecchia immmagine se esiste
            Storage::delete('uploads/' . $apartment->image_path);
        }
        $apartment->delete();
        return redirect()->route('admin.apartment.index')->with('success', 'Progetto cancellato definitivamente!');
    }
}
