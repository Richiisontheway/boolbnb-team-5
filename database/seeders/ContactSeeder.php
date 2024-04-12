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
        $apartments = Apartment::all();
        $contactData = config('messages');

        foreach ($apartments as $apartment) {
            $numberOfMessages = mt_rand(1, 20); 

            $randomContacts = collect($contactData)->shuffle()->take($numberOfMessages);

            foreach ($randomContacts as $randomContact) {
                $contact = new Contact();
                $contact->apartment_id = $apartment->id;
                $contact->name = $randomContact['name'];
                $contact->email = $randomContact['email'];
                $contact->message = $randomContact['message'];
                $contact->date = $randomContact['date'];
                $contact->save();
            }
        }
    }
}
