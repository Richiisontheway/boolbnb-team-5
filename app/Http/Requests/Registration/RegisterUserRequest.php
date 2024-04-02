<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'lastname.required' => 'Il campo cognome è obbligatorio.',
            'birthday.required' => 'Il campo data di nascita è obbligatorio.',
            'birthday.date' => 'Il campo data di nascita deve essere una data valida.',
            'email.required' => 'Il campo email è obbligatorio.',
            'email.email' => 'Inserisci un indirizzo email valido.',
            'email.unique' => 'Questo indirizzo email è già stato utilizzato.',
            'password.required' => 'Il campo password è obbligatorio.',
            'password.confirmed' => 'La conferma della password non corrisponde.',
            'password.min' => 'La password deve essere lunga almeno :min caratteri.',
        ];
    }
}
