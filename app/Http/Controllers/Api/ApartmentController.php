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
        $apartments = Apartment::with('services', 'sponsors') // Tramite Eager Loading gli dico di portarsi dietro le relazioni durante la serializzazione degli apartments
                    ->paginate(15);                        // Imposto la paginazione per mostrare 15 risultati in ogni pagina

        return response()->json([  
            'success' => true,
            'results' => $apartments
        ]);
    }
}
