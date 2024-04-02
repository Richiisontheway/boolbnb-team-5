<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Apartment;
use App\Models\User;
use App\Models\Service;

// Helpers
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Apartment::truncate();
        });

        // Estraggo gli appartamenti dal file in Config
        $apartmentData = config('apartments');

        // Estraggo i servizi
        $services = Service::all();
        
        // Creo gli appartamenti
        foreach ($apartmentData as $singleApartment) {

            $apartment = New Apartment();
            $user = User::inRandomOrder()->first();

            $apartment->user_id = $user->id;
            $apartment->title = $singleApartment['title'];
            $apartment->slug = Str::slug($singleApartment['title']);
            $apartment->n_rooms = $singleApartment['n_rooms'];
            $apartment->n_beds = $singleApartment['n_beds'];
            $apartment->n_baths = $singleApartment['n_baths'];
            $apartment->mq = $singleApartment['mq'];
            $apartment->price = $singleApartment['price'];
            $apartment->address = $singleApartment['address'];
            // $apartment->city = $singleApartment['city'];
            // $apartment->zip_code = $singleApartment['zip_code'];
            $apartment->lat = $singleApartment['lat'];
            $apartment->lon = $singleApartment['lon'];
            $apartment->cover_img = $singleApartment['cover_img'];
            $apartment->visible = $singleApartment['visible'];

            $apartment->save();

            // Determina il numero di servizi casuali da assegnare (da 1 a 5)
            $numberOfServices = min(5, $services->count()); // Assicura che il numero non superi la quantità disponibile
            // Ottieni un insieme casuale di servizi
            $randomServices = $services->random($numberOfServices);
            // Associa le servizi al progetto
            $apartment->services()->attach($randomServices->pluck('id')->toArray());

        
        }
    }


}
