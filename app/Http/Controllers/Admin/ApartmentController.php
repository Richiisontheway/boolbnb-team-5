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
        $user = auth()->user(); // Utilizza il metodo user() per ottenere l'utente autenticato
        $user_id = $user->id;
        //per vedere se i dati sono valitati dalla request
        $apartment_data = $request->validated();
        //per generare l'url con lo slug
        $slug = Str::slug($apartment_data['title']);

        $coverImgPath = null;
        if (isset($apartment_data['cover_img'])) {
            $coverImgPath = Storage::disk('public')->put('images', $apartment_data['cover_img']);            //$coverImgPath = Storage::disk('public')->put('images', $apartment_data['cover_img']);
        }

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
            'city' => $apartment_data['city'],
            'zip_code' => $apartment_data['zip_code'],
            'lat' => $apartment_data['lat'],
            'lon' => $apartment_data['lon'],
            //'services' => $apartment_data['services'],
            'cover_img' => $coverImgPath,
            'visible' => $apartment_data['visible']
        ]);
        foreach($apartment_data['services'] as $service){
            $apartment->services()->attach($service);
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
        return view('admin.apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentUpdateRequest $request, Apartment $apartment)
    {
         //per vedere se i dati sono valitati dalla request
        $apartment_data = $request->validated();
        //per generare l'url con lo slug
        $slug = Str::slug($apartment_data['title']);

        $coverImgPath = null;
        if (isset($postData['cover_img'])) {
            $coverImgPath = Storage::disk('public')->put('images', $postData['cover_img']);
        }
        $apartment = Apartment::create([
            'title' => $apartment_data['title'],
            'slug' => $slug,
            'n_rooms' => $apartment_data['n_rooms'],
            'n_beds' => $apartment_data['n_beds'],
            'n_baths' => $apartment_data['n_baths'],
            'mq' => $apartment_data['mq'],
            'price' => $apartment_data['price'],
            'address' => $apartment_data['address'],
            'city' => $apartment_data['city'],
            'zip_code' => $apartment_data['zip_code'],
            'cover_img' => $apartment_data['cover_img'],
            'visible' => $apartment_data['visible']
        ]);

        return redirect()->route('admin.apartments.show', compact('apartment'));
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
