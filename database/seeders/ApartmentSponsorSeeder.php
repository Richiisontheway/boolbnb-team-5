<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Sponsor;
use App\Models\Apartment;

class AppartmentSponsorSeeder extends Seeder
{
    public function run()
    {
        $apartments = Appartment::all();
        $sponsorships = Sponsorhip::pluck('id','time'); // Prendi tutti gli ID delle sponsorizzazioni disponibili

        // Assegna la data attuale come data di inizio per tutti gli appartamenti
        $date_start = now();

        // Per i primi 5 appartamenti, assegna un piano di sponsorizzazione casuale
        $count = 0;

        foreach ($apartments as $singleApartment) {
            if ($count < 5) {
                $sponsorship_id = $sponsorships->random(); // Seleziona casualmente un ID di sponsorizzazione
                $sponsorData = $sponsorships::find($sponsorship_id);

                $sponsorship_time = $sponsorData->time;

                $date_start = now();

                if ($sponsorship_time == 24) {
                    $date_end = now()->addHours(24); // Data di fine sponsorizzazione dopo un mese
                }
                elseif ($sponsorship_time == 72) {
                    $date_end = now()->addHours(72); // Data di fine sponsorizzazione dopo un mese
                } 
                elseif ($sponsorship_time == 144) {
                    $date_end = now()->addHours(144); // Data di fine sponsorizzazione dopo un mese
                };

                $singleApartment->sponsorships()->attach($sponsorship_id, [
                    'date_start' => $date_start,
                    'date_end' => $date_end,
                ]);

                $count++;

            } else {
                break; // Esci dal ciclo dopo aver assegnato i primi 5 appartamenti
            }
        }
    }
}