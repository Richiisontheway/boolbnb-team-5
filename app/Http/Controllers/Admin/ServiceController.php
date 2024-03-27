<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CreateResourceRequest;


use App\Models\Service;
use App\Models\Resource;
//controller
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;

class ServiceController extends Controller
{
    
       
        public function index()
        {
            
            $service = Service::all();
            return view('admin.services.index', compact('service'));
        }
    
        
        public function create()
        {
            return view('admin.services.create');
        }
    
        
        public function store(Request $request)
        {
                // Validare i dati inviati dalla richiesta
                $validatedData = $request->validated();

                // Creare la risorsa utilizzando i dati validati
               // $resource = new Resource();
               // $resource->title = $validatedData['title'];
              //  $resource->icon = $validatedData['icon'];
              //  $resource->save();

                 // Ritornare una risposta di successo o reindirizzare l'utente a una pagina di conferma, ecc.

        }
    
        
        public function show(Service $service)
        {

            // Recupera il servizio corrispondente all'ID fornito            

            // Passa il servizio alla vista per la visualizzazione
            return view('admin.services.show', compact('service'));
        }

    
       
        public function edit(string $id)
        {
           
            $Service = Service::where('id',$id)->firstOrFail();
            return view('admin.services.edit', compact('service'));
        }
    
        public function update(Request $request, Service $service)
        {
            
        }
    
        public function destroy(Service $service)
        {
            $service->delete();
            return redirect()->route('admin.services.index');
        }
    
}
