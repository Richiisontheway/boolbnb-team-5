<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Apartment;
use App\Models\Sponsor;

// Helpers
use Illuminate\Support\Facades\Schema;


class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::withoutForeignKeyConstraints(function () {
            Sponsor::truncate();
        });

        $sponsorData = config('sponsors');

        // Creo gli appartamenti
        foreach ($sponsorData as $singleSponsor) {

            $sponsor = New Sponsor();

            $sponsor->title = $singleSponsor['title'];
            $sponsor->price = $singleSponsor['price'];
            $sponsor->time = $singleSponsor['time'];

            $sponsor->save();

            
        }

    }
}
