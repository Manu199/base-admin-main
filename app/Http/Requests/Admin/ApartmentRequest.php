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
        'title'=>'required|min:8|max:50',
        'description'=>'required|min:15',
        'price' =>'required|numeric|regex:/^(?!0\d)\d{1,4}(.\d{1,2})?$/',
        'square_meters'=>'required|numeric|min:20',
        'num_of_room'=>'required|numeric|min:1',
        'num_of_bed'=>'required|numeric|min:1',
        'num_of_bathroom'=>'required|numeric|min:1',
        'country'=>'required|min:2',
        'street_address'=>'required|min:5',
        'city_name'=>'required|min:2',
        'postal_code'=>'required|min:4',
        ];


    }

    public function messages() {
        return [
            'title.required' => 'Il titolo è un campo richiesto',
            'title.min' => 'Il titolo deve contenere almeno 8 caratteri',
        ];
    }
}
