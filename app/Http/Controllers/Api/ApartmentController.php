<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Apartment;

class ApartmentController extends Controller
{
    //Dobbiamo recuperare i dati del DB ed esporli pubblicamente
    public function index() {


        // Recupero tutti i project
        $apartments = Apartment::with('services', 'sponsors')->get();  // Tramite Eager Loading gli dico di portarsi dietro le relazioni durante la serializzazione degli apartments
                    // ->paginate(20);                              // Imposto la paginazione per mostrare 15 risultati in ogni pagina

        return response()->json([  
            'success' => true,
            'results' => $apartments
        ]);
    }

    public function show(string $slug) {

        $apartment = Apartment::with('services', 'sponsors')
                    ->where('slug', $slug)
                    ->first();

        if ($apartment != null) {

            return response()->json([  
                'success' => true,
                'results' => $apartment
            ]);

        } else {
            return response()->json([
                'success' => false,
                'results' => null
            ]);
        }

    }

    public function getSponsoredApartments() {
        $apartments = Apartment::with('services', 'sponsors')
                        ->whereHas('sponsors') 
                        ->get(); 
    
        return response()->json([  
            'success' => true,
            'results' => $apartments
        ]);
    }
}
