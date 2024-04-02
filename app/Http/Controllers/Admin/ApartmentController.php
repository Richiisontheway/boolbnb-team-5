<?php

namespace App\Http\Controllers\Admin;

//controller
use App\Http\Controllers\Controller;

//model
use App\Models\Apartment;
use App\Models\Service;
use App\Models\User;

//request
use Illuminate\Http\Request;
use  App\Http\Requests\Apartment\StoreRequest as ApartmentStoreRequest;
use App\Http\Requests\Apartment\UpdateRequest as ApartmentUpdateRequest;

//helper
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// Guzzle
use GuzzleHttp\Client;

class ApartmentController extends Controller
{
    /**
     * lista delle risorse in pagina
     */
    public function index()
    {
        $user = auth()->user();

        //per restituirmi tutti i valori della tabella associati ai model
        // $apartment = Apartment::all();
        $apartments = Apartment::where('user_id', $user->id)->get();
        $services = Service::all();
        return view('admin.apartments.index', compact('apartments', 'services', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentStoreRequest $request)
    {
        // Istanzio un nuovo oggetto Guzzle per effettuare la chiamat API di TomTom
        $client = new Client();

        $apartment_data = $request->validated();

        // Effettuo una richiesta GET alla nostra API inserendo gli input dell'utenti estrapolati dalla Request (codificandoli in formato json)
       //vecchio con città
        // $response = $client->request('GET', 'https://api.tomtom.com/search/2/geocode/' . urlencode($apartment_data['address']) . '+' . urlencode($apartment_data['city']) . '.json?key=x5vTIPGVXKGawffLrAoysmnVC9V0S8cq', [
        //     'verify' => false, // Disabilita la verifica del certificato SSL
        // ]);

        //nuovo solo con unico campo
        $response = $client->request('GET', 'https://api.tomtom.com/search/2/geocode/' . urlencode($apartment_data['address']) . '.json?key=x5vTIPGVXKGawffLrAoysmnVC9V0S8cq', [
            'verify' => false, // Disabilita la verifica del certificato SSL
        ]);

        // Decodifico il corpo della risposta JSON
        $responseData = json_decode($response->getBody()->getContents(), true);

        // Estrai la posizione (latitudine e longitudine) dalla risposta
        $position = $responseData['results'][0]['position'];

        // Assegno i campi di latitudine e longitudine a delle variabili
        $lat = $position['lat'];
        $lon = $position['lon'];

        $user = auth()->user(); // Utilizza il metodo user() per ottenere l'utente autenticato
        $user_id = $user->id;
        
        //per vedere se i dati sono valitati dalla request
        //per generare l'url con lo slug
        $slug = Str::slug($apartment_data['title']);

        $coverImgPath = null;
        if (isset($apartment_data['cover_img'])) {
            $coverImgPath = Storage::disk('public')->put('img', $apartment_data['cover_img']);
        }
        // dd($coverImgPath);


        
        $apartment_data['cover_img'] = $coverImgPath;

        $apartment = Apartment::create([
            'user_id' =>$user_id,
            'title' => $apartment_data['title'],
            'slug' => $slug,
            'n_rooms' => $apartment_data['n_rooms'],
            'n_beds' => $apartment_data['n_beds'],
            'n_baths' => $apartment_data['n_baths'],
            'mq' => $apartment_data['mq'],
            'price' => $apartment_data['price'],
            'address' => $apartment_data['address'],
            // 'city' => $apartment_data['city'],
            // 'zip_code' => $apartment_data['zip_code'],
            'lat' => $lat,
            'lon' => $lon,
            //'services' => $apartment_data['services'],
            'cover_img' => $coverImgPath,
            'visible' => $apartment_data['visible']
        ]);
        //lo faccio funzionare solo se pieno
        if (!empty($apartment_data['services'])) {
            foreach($apartment_data['services'] as $service) {
                $apartment->services()->attach($service);
            }
        }

        return redirect()->route('admin.apartments.show', ['apartment' => $apartment->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        //serve per far funzionare lo uri con lo slug anziché che con l'id
        $apartment = Apartment::where('slug',$slug)->firstOrFail();
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        //serve per far funzionare lo uri con lo slug anziché che con l'id
        $apartment = Apartment::where('slug',$slug)->firstOrFail();
        $services = Service::all();
        return view('admin.apartments.edit', compact('apartment','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentUpdateRequest $request, string $slug)
    {
        // Istanzio un nuovo oggetto Guzzle per effettuare la chiamat API di TomTom
        $client = new Client();

        $apartment_data = $request->validated();

        // Effettuo una richiesta GET alla nostra API inserendo gli input dell'utenti estrapolati dalla Request (codificandoli in formato json)
        $response = $client->request('GET', 'https://api.tomtom.com/search/2/geocode/' . urlencode($apartment_data['address']) . '.json?key=x5vTIPGVXKGawffLrAoysmnVC9V0S8cq', [
            'verify' => false, // Disabilita la verifica del certificato SSL
        ]);

        // Decodifico il corpo della risposta JSON
        $responseData = json_decode($response->getBody()->getContents(), true);

        // Estrai la posizione (latitudine e longitudine) dalla risposta
        $position = $responseData['results'][0]['position'];

        // Assegno i campi di latitudine e longitudine a delle variabili
        $lat = $position['lat'];
        $lon = $position['lon'];

        $apartment = Apartment::where('slug', $slug)->firstOrFail();

        // Controlla se è stata selezionata un'immagine per la copertina
        if ($request->hasFile('cover_img')) {
            // Carica la nuova immagine di copertina e ottieni il percorso
            $coverImgPath = Storage::disk('public')->put('images', $apartment_data['cover_img']);
            
            // Elimina l'immagine di copertina attuale se presente
            if ($apartment->cover_img) {
                Storage::disk('public')->delete($apartment->cover_img);
            }
        } 
        // Altrimenti, controlla se è stata attivata l'opzione per eliminare l'immagine esistente
        elseif ($request->has('delete_cover_img')) {
            // Elimina l'immagine di copertina attuale
            if ($apartment->cover_img) {
                Storage::disk('public')->delete($apartment->cover_img);
            }
            
            // Imposta il percorso dell'immagine di copertina dell'appartamento su una stringa vuota per indicare l'assenza di un'immagine
            $coverImgPath = 'img/apt-missing.png';
            
            // Rimuovi 'cover_img' dall'array di dati dell'appartamento in modo che non venga sovrascritto
            unset($apartment_data['cover_img']);
        } 
        // Se non è stata effettuata alcuna modifica all'immagine di copertina, mantieni il percorso attuale
        else {
            $coverImgPath = $apartment->cover_img;
        }

        $apartment_data['slug'] = Str::slug($apartment_data['title']);
        $apartment_data['cover_img'] = $coverImgPath;
        $apartment_data['lat'] = $lat;
        $apartment_data['lon'] = $lon;

        if (isset($apartment_data['services'])) {
            $apartment->services()->sync($apartment_data['services']);
        } else {
            $apartment->services()->detach();
        }

        $apartment->update($apartment_data);

        return redirect()->route('admin.apartments.show' , ['apartment' => $apartment->slug]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect()->route('admin.apartments.index');
    }
}
