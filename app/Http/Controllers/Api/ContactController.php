<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Contact;
use App\Models\Apartment;

// Form Request
use App\Http\Requests\Contact\StoreRequest as ContactStoreRequest;

// Helpers
use Illuminate\Support\Facades\Mail;

// Mailable
use App\Mail\NewContact;

class ContactController extends Controller
{
    public function store(ContactStoreRequest $request) {

        // Creo una nuova istanza di Contact 
        $contact = Contact::create($request->validated());

        $apartment = Apartment::findOrFail($request->apartment_id);

        // Recupera il nome del proprietario dell'appartamento
        $ownerName = $apartment->user->name;

        // Mail::to($apartment->user->email)->send(new NewContact($contact));
        Mail::to($apartment->user->email)->send(new NewContact($contact, $ownerName));

        return response()->json([
            'success' => true,
            'message' => 'Contatto salvato'
        ]);

        // return response()->json($request->all());
    }
}
