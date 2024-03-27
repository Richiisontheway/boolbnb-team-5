<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Sponsor;
use App\Models\Apartment;

class ApartmentSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sponsor = Sponsor::all();
        
        $apartments = Apartment::all();

        for ($i = 0; $i < 5; $i++) {
            $apartments[$i]->
        }

        
        if ($sponsor->time == 24) {
            $table->timestamp('date_end' )
        }
}
}
