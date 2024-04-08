<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Helper
use GuzzleHttp\Client;

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

    public function advancedSearch(Request $request)
    {
        $address = $request->input('address');
        $radius = $request->input('radius');

        // Ottieni le coordinate dall'indirizzo utilizzando l'API di geocodifica
        $coordinates = $this->getCoordinatesFromAddress($address);

        $filteredApartments = Apartment::whereRaw(
            'ACOS(SIN(RADIANS(lat)) * SIN(RADIANS(?)) + COS(RADIANS(lat)) * COS(RADIANS(?)) * COS(RADIANS(ABS(lon - ?)))) * 6371 <= ?',
            [
                $coordinates['lat'],
                $coordinates['lat'],
                $coordinates['lon'],
                $radius
            ]
        )->get();

        return response()->json(['results' => $filteredApartments]);
    }

    private function getCoordinatesFromAddress($address)
    {
        $apiKey = 'x5vTIPGVXKGawffLrAoysmnVC9V0S8cq';
        $client = new Client();

        try {
            $response = $client->get("https://api.tomtom.com/search/2/geocode/{$address}.json?key={$apiKey}");
            $data = json_decode($response->getBody(), true);

            // Verifica se ci sono risultati
            if (isset($data['results']) && !empty($data['results'])) {
                $lat = $data['results'][0]['position']['lat'];
                $lon = $data['results'][0]['position']['lon'];

                return ['lat' => $lat, 'lon' => $lon];
            } else {
                return null;
            }
        } catch (\Exception $e) {
            // Gestisci l'errore
            return null;
        }
    }

}
