<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//controller
use App\Http\Controllers\Controller;

//model
use App\Models\Sponsor;
use App\Models\Apartment;


// http://127.0.0.1:8000/admin/sponsors
//helper
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{

    public function index()
    {
        $sponsors = Sponsor::all();
        return view('admin.sponsors.index', compact('sponsors'));
    }

    public function sponsorizeApartment(Request $request, $id)
    {
        $apartment = Apartment::findOrFail($id);
        $sponsor = Sponsor::findOrFail($request->sponsor_id);

        // Assicurati che l'appartamento non sia già sponsorizzato con lo stesso tipo di sponsorizzazione
        if (!$apartment->sponsors()->where('sponsor_id', $sponsor->id)->exists()) {
            $apartment->sponsors()->attach($sponsor);
            return redirect()->back()->with('success', 'Appartamento sponsorizzato con successo.');
        } else {
            return redirect()->back()->with('error', 'L\'appartamento è già sponsorizzato con questo tipo.');
        }
    }

    public function removeSponsorship(Request $request, $id)
    {
        $apartment = Apartment::findOrFail($id);
        $sponsor = Sponsor::findOrFail($request->sponsor_id);

        // Verifica se l'appartamento è sponsorizzato con il tipo specificato
        if ($apartment->sponsors()->where('sponsor_id', $sponsor->id)->exists()) {
            $apartment->sponsors()->detach($sponsor);
            return redirect()->back()->with('success', 'Sponsorizzazione rimossa con successo.');
        } else {
            return redirect()->back()->with('error', 'L\'appartamento non è sponsorizzato con questo tipo.');
        }
    }
}

