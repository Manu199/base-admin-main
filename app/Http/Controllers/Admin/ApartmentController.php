<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Service;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $title = 'Crea';
        $method = 'POST';
        $route = route('admin.apartment.store');
        $apartment = null;
        $services = Service::all();
        return view('admin.apartments.create_edit', compact('title', 'route', 'method', 'apartment', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $form_data = $request->all();
        $temp_path = null;

        // verifico se non è null tempImagePath se esiste ritorno temp_path aggiornato
        if ($form_data['tempImagePath']) {
            $temp_path = $form_data['tempImagePath'];
        }

        // verifico se non è null l'immagine
        if (array_key_exists('image_path', $form_data)) {
            if ($temp_path) {
                Storage::delete('temp/' . $temp_path);
            }
            $img_path = Storage::put('temp', $form_data['image_path']);
            $temp_path = basename($img_path);

            // Rimuovi il campo 'image_path' dalla richiesta
            unset($form_data['image_path']);
        }

        $validator = Validator::make($form_data, [
            'title' => 'required|min:8|max:50',
            'description' => 'required|min:15',
            'price' => 'required|numeric|min:1',
            'square_meters' => 'required|numeric|min:20',
            'num_of_room' => 'required|numeric|min:1',
            'num_of_bed' => 'required|numeric|min:1',
            'num_of_bathroom' => 'required|numeric|min:1',
            'address' => 'required|min:5',
            'image_path' => 'required|file|mimes:jpeg,jpg,png,gif|max:65535',
            'services' => 'required|array|min:1',
        ], [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.min' => 'Il titolo deve essere lungo almeno :min caratteri.',
            'title.max' => 'Il titolo non può superare :max caratteri.',

            'description.required' => 'La descrizione è obbligatoria.',
            'description.min' => 'La descrizione deve essere lunga almeno :min caratteri.',

            'price.required' => 'Il prezzo è obbligatorio.',
            'price.numeric' => 'Il prezzo deve essere un numero.',
            'price.min' => 'Il prezzo deve essere almeno :min euro.',

            'square_meters.required' => 'I metri quadrati sono obbligatori.',
            'square_meters.numeric' => 'I metri quadrati devono essere un numero.',
            'square_meters.min' => 'I metri quadrati devono essere almeno :min.',

            'num_of_room.required' => 'Il numero di stanze è obbligatorio.',
            'num_of_room.numeric' => 'Il numero di stanze deve essere un numero.',
            'num_of_room.min' => 'Il numero di stanze deve essere almeno :min.',

            'num_of_bed.required' => 'Il numero di camere da letto è obbligatorio.',
            'num_of_bed.numeric' => 'Il numero di camere da letto deve essere un numero.',
            'num_of_bed.min' => 'Il numero di camere da letto deve essere almeno :min.',

            'num_of_bathroom.required' => 'Il numero di bagni è obbligatorio.',
            'num_of_bathroom.numeric' => 'Il numero di bagni deve essere un numero.',
            'num_of_bathroom.min' => 'Il numero di bagni deve essere almeno :min.',

            'address.required' => 'L\'indirizzo è obbligatorio.',
            'address.min' => 'L\'indirizzo deve essere lungo almeno :min caratteri.',

            'image_path.required' => 'L\'immagine è obbligatoria.',
            'image_path.file' => 'Il campo :attribute deve essere un file.',
            'image_path.mimes' => 'L\'immagine deve essere di uno dei seguenti formati: jpeg, jpg, png, gif.',
            'image_path.max' => 'L\'immagine non può superare :max kilobytes.',

            'services.required' => 'Inserisci almeno 1 servizio.',
            'services.array' => 'Il campo Servizi deve essere un array.',
            'services.min' => 'Il campo Servizi deve contenere almeno :min elemento.',
        ],);

        if ($validator->fails()) {
            if ($temp_path) {
                // se ho un temp_path allora non genero l'errore di image_path
                $errors = $validator->errors();
                $errors->forget('image_path');
                // se è stato inserita un'immagine allora la rinvio indietro con una variabile di sessione
                if (count($errors)) {
                    return redirect()->back()->withErrors($validator)->withInput()->with('tempImagePath', $temp_path);
                }
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        // validazione superata, ora sposto il file temporanea nella mia cartella di upload
        $percorsoOrigine = 'temp/' . $temp_path; // Imposta il percorso del file originale
        $percorsoDestinazione = 'uploads/' . $temp_path; // Imposta il percorso di destinazione

        // Sposta il file dalla cartella temp alla cartella uploads
        Storage::put($percorsoDestinazione, Storage::get($percorsoOrigine));
        $form_data['image_path'] = $temp_path;
        Storage::delete($percorsoOrigine);

        $form_data['user_id'] = Auth::id();
        $form_data['type_id'] = 1; // debug
        $form_data['slug'] = Helper::generateSlug($form_data['title'], Apartment::class);

        // chiamata all'api tom tom
        // https://api.tomtom.com/search/2/geocode/Via Roma 33.json?key=JFycdOFju9JHTRcWGALUGaqq5FULPTe8
        $apiUrl = 'https://api.tomtom.com/search/2/geocode/';
        $apiQuery = $form_data['address'] . '.json';
        $encodedAddress = urlencode($apiQuery);
        $apiKey = '?key=JFycdOFju9JHTRcWGALUGaqq5FULPTe8';

        $endpoint = $apiUrl . $encodedAddress . $apiKey;

        // Ottenere il contenuto dell'endpoint come stringa
        $data = file_get_contents($endpoint);

        // Decodifica della stringa JSON come array associativo
        $data_decode = json_decode($data, true);

        $address = $data_decode['results'][0]['address'];
        $position = $data_decode['results'][0]['position'];

        $form_data['address'] = $address['freeformAddress'];

        $form_data['lat'] = $position['lat'];
        $form_data['lon'] = $position['lon'];

        // visible
        if (!array_key_exists('visible', $form_data)) {
            $form_data['visible'] = 0;
        } else {
            $form_data['visible'] = 1;
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
            abort(404);
        }

        $sponsors = Sponsor::all();
        $messages = Message::where('apartment_id', $apartment->id)->orderBy('date', 'desc')->take(5)->get();
        return view('admin.apartments.show', compact('apartment', 'sponsors', 'messages'));
    }

    public function listMessages(Apartment $apartment)
    {
        $messages = Message::where('apartment_id', $apartment->id)->orderBy('date', 'desc')->get();
        return view('admin.apartments.listMessages', compact('messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        if ($apartment->user_id != Auth::id()) {
            abort(404);
        }

        $title = 'Modifica';
        $method = 'PUT';
        $route = route('admin.apartment.update', $apartment);
        $services = Service::all();

        return view('admin.apartments.create_edit', compact('title', 'route', 'method', 'apartment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $form_data = $request->all();

        $valImage = Validator::make($request->only('image_path'), [
            'image_path' => 'file|mimes:jpeg,jpg,png,gif|max:65535',
        ], [
            'image_path.file' => 'Il campo :attribute deve essere un file.',
            'image_path.mimes' => 'L\'immagine deve essere di uno dei seguenti formati: jpeg, jpg, png, gif.',
            'image_path.max' => 'L\'immagine non può superare :max kilobytes.',
        ]);

        // controllo che nei miei dati ricevuti dal form sia stata aggiunta un'immagine
        if (array_key_exists('image_path', $form_data)) {
            if ($apartment->image_path) {
                // cancello la vecchia immmagine se esiste
                Storage::delete('uploads/' . $apartment->image_path);
            }
            // inserisco la nuova immagine
            $img_path = Storage::put('uploads', $form_data['image_path']);
            $only_image['image_path'] = basename($img_path);
            $apartment->update($only_image);
        }
        unset($form_data['image_path']);

        $validator = Validator::make($form_data, [
            'title' => 'required|min:8|max:50',
            'description' => 'required|min:15',
            'price' => 'required|numeric|min:1',
            'square_meters' => 'required|numeric|min:20',
            'num_of_room' => 'required|numeric|min:1',
            'num_of_bed' => 'required|numeric|min:1',
            'num_of_bathroom' => 'required|numeric|min:1',
            'address' => 'required|min:5',
            'services' => 'required|array|min:1',
        ], [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.min' => 'Il titolo deve essere lungo almeno :min caratteri.',
            'title.max' => 'Il titolo non può superare :max caratteri.',

            'description.required' => 'La descrizione è obbligatoria.',
            'description.min' => 'La descrizione deve essere lunga almeno :min caratteri.',

            'price.required' => 'Il prezzo è obbligatorio.',
            'price.numeric' => 'Il prezzo deve essere un numero.',
            'price.min' => 'Il prezzo deve essere almeno :min euro.',

            'square_meters.required' => 'I metri quadrati sono obbligatori.',
            'square_meters.numeric' => 'I metri quadrati devono essere un numero.',
            'square_meters.min' => 'I metri quadrati devono essere almeno :min.',

            'num_of_room.required' => 'Il numero di stanze è obbligatorio.',
            'num_of_room.numeric' => 'Il numero di stanze deve essere un numero.',
            'num_of_room.min' => 'Il numero di stanze deve essere almeno :min.',

            'num_of_bed.required' => 'Il numero di camere da letto è obbligatorio.',
            'num_of_bed.numeric' => 'Il numero di camere da letto deve essere un numero.',
            'num_of_bed.min' => 'Il numero di camere da letto deve essere almeno :min.',

            'num_of_bathroom.required' => 'Il numero di bagni è obbligatorio.',
            'num_of_bathroom.numeric' => 'Il numero di bagni deve essere un numero.',
            'num_of_bathroom.min' => 'Il numero di bagni deve essere almeno :min.',

            'address.required' => 'L\'indirizzo è obbligatorio.',
            'address.min' => 'L\'indirizzo deve essere lungo almeno :min caratteri.',

            'services.required' => 'Inserisci almeno 1 servizio.',
            'services.array' => 'Il campo Servizi deve essere un array.',
            'services.min' => 'Il campo Servizi deve contenere almeno :min elemento.',
        ],);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // se il titolo dell'appartamento cambia, cambia anche lo slug
        if ($apartment->title === $form_data['title']) {
            $form_data['slug'] = $apartment->slug;
        } else {
            $form_data['slug'] = Helper::generateSlug($form_data['title'], Apartment::class);
        }

        // se ['street_address'] ['postal_code'] sono cambiati, cambio dati di tom tom
        if ($apartment->address !== $form_data['address']) {
            $apiUrl = 'https://api.tomtom.com/search/2/geocode/';
            $apiQuery = $form_data['address'] . '.json';
            $encodedAddress = urlencode($apiQuery);
            $apiKey = '?key=JFycdOFju9JHTRcWGALUGaqq5FULPTe8';

            $endpoint = $apiUrl . $encodedAddress . $apiKey;

            // Ottenere il contenuto dell'endpoint come stringa
            $data = file_get_contents($endpoint);

            // Decodifica della stringa JSON come array associativo
            $data_decode = json_decode($data, true);

            $address = $data_decode['results'][0]['address'];
            $position = $data_decode['results'][0]['position'];

            $form_data['address'] = $address['freeformAddress'];

            $form_data['lat'] = $position['lat'];
            $form_data['lon'] = $position['lon'];
        }

        // visible
        if (!array_key_exists('visible', $form_data)) {
            $form_data['visible'] = 0;
        } else {
            $form_data['visible'] = 1;
        }



        $apartment->update($form_data);

        // Update della tabella pivot
        $apartment->services()->detach();
        if (array_key_exists('services', $form_data)) {
            $apartment->services()->attach($form_data['services']);
        }

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
