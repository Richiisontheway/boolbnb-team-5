<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Helper
use GuzzleHttp\Client;

// Models
use App\Models\Apartment;
use App\Models\Service;

class ApartmentController extends Controller
{
    //Recupero gli appartamenti dal DB
    public function index() {


        // Recupero tutti i project
        $apartments = Apartment::with('services', 'sponsors')->get();  // Tramite Eager Loading gli dico di portarsi dietro le relazioni durante la serializzazione degli apartments

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
        $now = now();
        
        $apartments = Apartment::with('services', 'sponsors')
                        ->whereHas('sponsors', function ($query) use ($now) {
                            $query->where('date_end', '>', $now);
                        })
                        ->get(); 
    
        return response()->json([  
            'success' => true,
            'results' => $apartments
        ]);
    }
    // Definisco una funzione per la ricerca avanzata degli appartamenti
    public function advancedSearch(Request $request)
    {   
        // Definsco delle variabili a cui assegno gli input dell'utente
        $address = $request->input('address');
        $radius = $request->input('radius');
        $minRooms = $request->input('minRooms');
        $minBeds = $request->input('minBeds');
        $services = $request->input('services');
        $filterTitle = $request->input('filterTitle');

        // Ottengo le coordinate dall'indirizzo utilizzando l'API di geocodifica
        $coordinates = $this->getCoordinatesFromAddress($address);

        // Filtro gli appartamenti cercando gli appartamenti in base alle coordinate 
        $filteredApartments = Apartment::whereRaw(
            'ACOS(SIN(RADIANS(lat)) * SIN(RADIANS(?)) + COS(RADIANS(lat)) * COS(RADIANS(?)) * COS(RADIANS(ABS(lon - ?)))) * 6371 <= ?',
            [
                $coordinates['lat'],
                $coordinates['lat'],
                $coordinates['lon'],
                $radius
            ]
            );

            // Se l'utente ha selezionato un numero di stanze
            if ($minRooms) {
                // Filtro gli appartamenti
                $filteredApartments->where('n_rooms', '>=', $minRooms);
            }
        
            // Se l'utente ha selezionato un numero di letti
            if ($minBeds) {
                // Filtro gli appartamenti
                $filteredApartments->where('n_beds', '>=', $minBeds);
            }

            // Se l'utente ha selezionato dei servizi
            if($services) {
                foreach ($services as $serviceId) {
                    // Filtro gli appartamenti
                    $filteredApartments->whereHas('services', function ($query) use ($serviceId) {
                        $query->where('service_id', $serviceId);
                    });
                }
            }

            // Se l'utente sta cercando per nome dell'appartamento
            if ($filterTitle) {
                $filteredApartments->where('title', 'like', '%'.$filterTitle.'%');
            }
        
            // Eseguo la query per ottenere i risultati filtrati
            $results = $filteredApartments->get();

        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    }
    // Definisco una funzione per calcolare le coordinate degll'indirizzo scelto dall'utente
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
    // Definisco una funzione per recuperare i servizi dal DB
    public function getServices() {
        $services = Service::all();

        return response()->json([  
            'success' => true,
            'results' => $services
        ]);

    }

}
