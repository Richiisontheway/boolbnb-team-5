<?php

namespace App\Http\Requests\Apartment;

use Illuminate\Foundation\Http\FormRequest;

// Helpers
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //ci sono le regole per ogni dato della tabella apartment
        return [
            'title' =>'required|string|Max:255',
            'n_rooms' => 'required|numeric|Min:1|Max:10',
            'n_beds' => 'required|numeric|Min:1|Max:10',
            'n_baths' => 'required|numeric|Min:1|Max:10',
            'mq' => 'required|numeric|Min:1|Max:1000',
            'price' => 'required|numeric|decimal:0,2|Min:1|Max:999.99',
            'address' => 'required|string|Min:1|Max:64',
            // 'city' => 'required|string|Min:2|Max:64',
            // 'zip_code' => 'required|numeric|digits:5',
            'services' => 'nullable|array|exists:services,id',
            'visible' => 'required|Boolean',
            'delete_cover_img' => 'nullable|boolean'
        ];

        // Aggiungi la regola required_if per 'cover_img' se 'delete_cover_img' non è selezionato
        if (!$this->input('delete_cover_img')) {
            $rules['cover_img'] = 'required|image';
        }

    }
    
    public function messages()
    {
        return [
            'required' => 'il campo è obbligatorio',
            'numeric' => "il campo dev'essere un numero",
            'n_rooms.min' => "il campo dev'essere di almeno 1 e massimo 10",
            'n_rooms.max' => "il campo dev'essere di almeno 1 e massimo 10",
            'n_beds.min' => "il campo dev'essere di almeno 1 e massimo 10",
            'n_beds.max' => "il campo dev'essere di almeno 1 e massimo 10",
            'n_baths.min' => "il campo dev'essere di almeno 1 e massimo 10",
            'n_baths.max' => "il campo dev'essere di almeno 1 e massimo 10",
            'mq.min' => "i mq devono essere tra 1 e 1000",
            'mq.max' => "i mq devono essere tra 1 e 1000",
            'price.min' => 'Il prezzo a notte deve essere un valore numerico e compreso tra 1 e 999.99',
            'price.max' => 'Il prezzo a notte deve essere un valore numerico e compreso tra 1 e 999.99',
            'cover_img.image' => "l'immagine dev'essere un file"
        ];
    }
}
