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
        //per restituirmi tutti i valori della tabella associati al model
        $contacts = Contact::all();
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
