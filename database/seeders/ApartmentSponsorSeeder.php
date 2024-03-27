<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Sponsor;
use App\Models\Apartment;

class ApartmentSponsorSeeder extends Seeder
{
    public function run()
    {
        $apartments = Apartment::all();
        $sponsorships = Sponsor::pluck('time','id'); // Prendi tutti gli ID delle sponsorizzazioni disponibili
       
        // Assegna la data attuale come data di inizio per tutti gli appartamenti
        

        // Per i primi 5 appartamenti, assegna un piano di sponsorizzazione casuale
        $count = 0;
        $date_start = now();
        $date_end=null;
        foreach ($apartments as $singleApartment) {
            if ($count < 5) {
                $sponsorship_id = Sponsor::inRandomOrder()->value('id'); // Seleziona casualmente una chiave (id)
                $sponsorship_time = $sponsorships->get($sponsorship_id); // Ottieni il valore 'time' corrispondente all'id
                
                // Calcola la data di fine sponsorizzazione in base al 'time'
                $date_end = $date_start->copy(); // Copia la data di inizio per evitare di modificarla direttamente
                if ($sponsorship_time == 24) {
                    $date_end->addHours(24); // Data di fine sponsorizzazione dopo 24 ore
                } elseif ($sponsorship_time == 72) {
                    $date_end->addHours(72); // Data di fine sponsorizzazione dopo 72 ore
                } elseif ($sponsorship_time == 144) {
                    $date_end->addHours(144); // Data di fine sponsorizzazione dopo 144 ore
                }
                
                // Associa il piano di sponsorizzazione all'appartamento
                $singleApartment->sponsors()->attach($sponsorship_id, [
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