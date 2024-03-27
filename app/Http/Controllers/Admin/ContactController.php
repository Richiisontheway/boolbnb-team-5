<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//controller
use App\Http\Controllers\Controller;

// Models
use App\Models\Contact;

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
        // Creo una query che indipendentemente dall'inserimento di dati negli input
        // mi restituirà di base tutti i contatti
        $contactsQuery = Contact::select('*');

        $queryStringParams = request()->all();    

        // Se sto filtrando per nome
        if(isset($queryStringParams['name'])) {
            $contactsQuery->where('name', 'LIKE', '%'.$queryStringParams['name'].'%');
        }

        // Se sto filtrando per mail
        if(isset($queryStringParams['email'])) {
            $contactsQuery->where('email', 'LIKE', '%'.$queryStringParams['email'].'%');
        }
        
        // Eseguo la query
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
