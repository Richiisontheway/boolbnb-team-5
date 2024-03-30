<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Contact;
use App\Models\Apartment;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Schema::withoutForeignKeyConstraints(function () {
        //     Contact::truncate();
        // });

        $apartment = Apartment::all();

        $contactData = config('messages');

        foreach ($contactData as $singleContact) {

            $contact = New Contact();
            $apartment = Apartment::inRandomOrder()->first();

            $contact->apartment_id = $apartment->id;
            $contact->name = $singleContact['name'];
            $contact->email = $singleContact['email'];
            $contact->message = $singleContact['message'];
            $contact->apartment_id = $singleContact['apartment_id'];
            $contact->save();
        }


    }
}
