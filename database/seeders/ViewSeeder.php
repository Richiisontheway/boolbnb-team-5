<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
//model

use App\Models\Apartment;
use App\Models\View;


class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            View::truncate();
        });

        // Estraggo gli appartamenti dal file in Config
        $viewsData = config('apartments');

        // Estraggo i servizi
        $apartment = Apartment::all();
        
        // Creo gli appartamenti
        foreach ($viewsData as $singleView) {

            $view = New View();
            $apartmentData = $apartment::inRandomOrder()->first();

            $view->apartment_id = $apartmentData->id;
            $view->user_ip = $singleView['user_ip'];
            $view->date = $singleView['date'];

            $view->save();

           
    }
}
}