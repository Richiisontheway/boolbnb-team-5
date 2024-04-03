<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
//controller
use App\Http\Controllers\Controller;
use Braintree\Configuration;
use Braintree;

//model
use App\Models\Sponsor;
use App\Models\Apartment;


// http://127.0.0.1:8000/admin/sponsors
//helper
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Exception;

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

    public function show($apartment_id)
    {   
        
        // Configura Braintree con le chiavi di accesso da .env
        Configuration::environment(env('BRAINTREE_ENV'));
        Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
        $sponsors = Sponsor::all();
        $token = Braintree\ClientToken::generate();
        return view('admin.apartments.sponsor', compact('sponsors', 'apartment_id', 'token'));
    }

    public function pay(Request $request, $apartment_id)
    {   
        $validatedData = $request->validate([
            'sponsor' => 'required|exists:sponsors,id',
            'payment_method_nonce' => 'required'
        ]);

        $sponsorId = $validatedData['sponsor'];
        $nonce = $validatedData['payment_method_nonce'];
        
        // Simulazione di pagamento con Braintree
        try {
            $result = Braintree\Transaction::sale([
                'amount' => '10.00', // Importo della transazione
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
           
            if ($result->success) {
                // Pagamento completato con successo
                $paymentSuccess = true;
            } else {
                // Pagamento non riuscito
                $paymentSuccess = false;
            }
        } catch (Exception $e) {
            // Gestione degli errori
            $paymentSuccess = false;
        }

        if ($paymentSuccess) {
        
            // Associa la sponsorizzazione all'appartamento utilizzando il metodo attach
            Apartment::find($apartment_id)->sponsors()->attach($sponsorId);

            return redirect()->route('admin.apartments')->with('success', 'Sponsorship added successfully.');
        } else {
     
            return redirect()->back()->with('error', 'Payment failed. Please try again.');
        }
    }
}

