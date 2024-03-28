<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//controller
use App\Http\Controllers\Controller;

// Models
use App\Models\Contact;
//model
use App\Models\Apartment;

//helper
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * lista delle risorse in pagina
     */
    public function index()
    {
        //controllo utente loggato
        $user = auth()->user();
        //cerco tra gli appartamenti l'id dell'utente loggato
        $apartments = Apartment::where('user_id', $user->id)->get();

        //cerco tra i messaggi tutti i messagi che hanno come apartment_id gli apt dell'utente loggato
        $contactsQuery = Contact::whereIn('apartment_id', $apartments->pluck('id')->toArray());

        $queryStringParams = request()->all();    

        // filtro per nome
        if(isset($queryStringParams['name'])) {
            $contactsQuery->where('name', 'LIKE', '%'.$queryStringParams['name'].'%');
        }

        // filtro per mail
        if(isset($queryStringParams['email'])) {
            $contactsQuery->where('email', 'LIKE', '%'.$queryStringParams['email'].'%');
        }
        
        $contacts = $contactsQuery->get();

        return view('admin.contacts.index', compact('contacts'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));    
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {

        $contact->delete();

        return redirect()->route('admin.contacts.index');
        
    }
}
