<?php

namespace App\Http\Requests\Apartment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
    */
    public function authorize(): bool
    {
        //serve per capire se l'utente è autorizzato(loggato) a fare delle request
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     *  @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
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
            'city' => 'required|string|Min:2|Max:64',
            'zip_code' => 'required|numeric|digits:5',
            'cover_img' => 'required',
            'visible' => 'required|Boolean:true'
        ]; 
    }
    
    //funzione per la generazione degli errori

    public function messages()
    {
        return [
            'required' => 'il campo è obbligatorio',
            //questo errore scatta sia nel caso in cui il price non è numeric 
            //sia nel caso in cui non rispetti i min e max
            'price.numeric' => 'Il campo prezzo deve essere un valore numerico e compreso tra :min e :max.',
            'zip_code' => "il cap dev'essere di 5 numeri",
            'cover_img' => "l'immagine dev'essere un file"
        ];
    }
}
