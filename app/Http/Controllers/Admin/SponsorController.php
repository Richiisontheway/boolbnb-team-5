<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
//controller
use App\Http\Controllers\Controller;
use Braintree\Configuration;
use Braintree;
use Braintree\Gateway;

//model
use App\Models\Sponsor;
use App\Models\Apartment;

//Facades
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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
        $user = Auth::user();
        
        $unsponsoredApartments = Apartment::leftJoin('apartment_sponsor', function($join) {
            $join->on('apartments.id', '=', 'apartment_sponsor.apartment_id')
                 ->where('apartment_sponsor.date_end', '>', now());
        })
        ->where('apartments.user_id', $user->id)
        ->whereNull('apartment_sponsor.id')
        ->get(['apartments.*']);
        
        return view('admin.sponsors.index', compact('sponsors', 'unsponsoredApartments'));
    }

    public function show($apartment_id)
    {   
        $user = Auth::user();

        // Verifica che l'appartamento appartenga all'utente loggato
        $apartment = Apartment::where('id', $apartment_id)
            ->where('user_id', $user->id)
            ->first();

        // Controlla se l'appartamento esiste e appartiene all'utente
        if (!$apartment) {
            // Se l'appartamento non esiste o non appartiene all'utente, reindirizza con un messaggio di errore
            return redirect()->back()->withErrors(['error' => 'Oops.. non abbiamo trovato l\' appartamento!']);
        }

        $apartmentTitle = $apartment->title;

        // Recupera l'ultima sponsorizzazione attiva dell'appartamento
        $latestSponsorship = DB::table('apartment_sponsor')
                            ->where('apartment_id', $apartment_id)
                            ->where('date_end', '>=', Carbon::now())
                            ->orderBy('date_end', 'desc')
                            ->first();

        // Verifica se esiste una sponsorizzazione attiva
        $isActive = $latestSponsorship !== null;

        if ($isActive) {
            // Se l'appartamento è già sponsorizzato, reindirizza con un messaggio di errore
            return redirect()->back()->withErrors(['error' => 'Oops.. ci deve essere stato un errore.']);
        }

        Configuration::environment(env('BRAINTREE_ENV'));
        Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));

        $sponsors = Sponsor::all();
        $token = Braintree\ClientToken::generate();

        return view('admin.apartments.sponsor', compact('sponsors', 'apartment_id', 'token', 'apartmentTitle'));
    }

    public function pay(Request $request, $apartment_id)
    {   
        Configuration::environment(env('BRAINTREE_ENV'));
        Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));

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
            $sponsor = Sponsor::findOrFail($sponsorId);
            
            // Calcola la data di inizio sponsorizzazione (data corrente)
            $date_start = now();

            // Calcola la data di fine sponsorizzazione aggiungendo il tempo della sponsorizzazione
            $date_end = $date_start->copy()->addHours($sponsor->time);
            // Associa il piano di sponsorizzazione all'appartamento con le date di inizio e fine
            Apartment::find($apartment_id)->sponsors()->attach($sponsor, [
                'date_start' => $date_start,
                'date_end' => $date_end,
            ]);

            
            return redirect()->route('admin.apartments.show', $apartment_id)->with('success', 'Sponsorship added successfully.');
        } else {
            return redirect()->back()->with('error', 'Payment failed. Please try again.');
        }
    }
}

