<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'title' => 'required|min:8|max:50',
        'description' => 'required|min:15',
        'price' => 'required|numeric|min:1',
        'square_meters' => 'required|numeric|min:20',
        'num_of_room' => 'required|numeric|min:1',
        'num_of_bed' => 'required|numeric|min:1',
        'num_of_bathroom' => 'required|numeric|min:1',
        'country' => 'required|min:2',
        'street_address' => 'required|min:5',
        'city_name' => 'required|min:2',
        'postal_code' => 'required|min:4',
        'image_url' => 'required|url|regex:/.(jpeg|jpg|png|gif)$/i'
        ];


    }

    public function messages() {
        return [
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

            'country.required' => 'Il paese è obbligatorio.',
            'country.min' => 'Il paese deve essere lungo almeno :min caratteri.',

            'street_address.required' => 'L\'indirizzo è obbligatorio.',
            'street_address.min' => 'L\'indirizzo deve essere lungo almeno :min caratteri.',

            'city_name.required' => 'Il nome della città è obbligatorio.',
            'city_name.min' => 'Il nome della città deve essere lungo almeno :min caratteri.',

            'postal_code.required' => 'Il codice postale è obbligatorio.',
            'postal_code.min' => 'Il codice postale deve essere lungo almeno :min caratteri.',

            'image_url.required' => 'Il campo URL dell\'immagine è obbligatorio.',
            'image_url.url' => 'Il campo URL dell\'immagine deve essere un URL valido.',
            'image_url.regex' => 'Il campo URL dell\'immagine deve avere un\'estensione valida (.jpeg, .jpg, .png, .gif).'
        ];
    }
}
