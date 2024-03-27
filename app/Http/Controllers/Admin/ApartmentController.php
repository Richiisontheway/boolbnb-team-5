<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//controller
use App\Http\Controllers\Controller;

//model
use App\Models\Apartment;

//request
use  App\Http\Requests\Apartment\StoreRequest as ApartmentStoreRequest;

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
    public function store(Request $request)
    {
        //per prendere i dati dalla richiesta
        // $data = $request;
        // $apartment = new Apartment();

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
    public function update(Request $request, Apartment $apartment)
    {
        //
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
