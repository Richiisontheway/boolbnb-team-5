<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//controller
use App\Http\Controllers\Controller;

//model
use App\Models\Apartment;

//request
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
        //per restituirmi tutti i valori della tabella associati al model
        $apartment = Apartment::all();
        return view('admin.apartments.index', compact('apartment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentStoreRequest $request)
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
