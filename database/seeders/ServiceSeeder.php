<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Service;

// Helpers
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Service::truncate();
        });

        // Estraggo i servizi dal file in Config
        $serviceData = config('servicesBnb');

        // Creo i servizi
        foreach ($serviceData as $singleService) {

            $service = New Service();

            $service->title = $singleService['title'];
            $service->icon = $singleService['icon'];

            $service->save();
        }

    }
}
