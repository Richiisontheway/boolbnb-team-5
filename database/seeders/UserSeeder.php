<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models 
use App\Models\User;

// Helpers
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
        public function run(): void
        {
            {
                Schema::disableForeignKeyConstraints();
                User::truncate();
                Schema::enableForeignKeyConstraints();
        
                $allUsers = [
                    [
                        'name' => 'Diego',
                        'lastname' => 'Giordano',
                        'birthday' => '1996-05-13',
                        'email' => 'diegomgiordano96@gmail.com',
                        'password' => 'password',
                    ],
                    [
                        'name' => 'Nicola',
                        'lastname' => 'Ceccagnoli',
                        'birthday' => '1994-11-02',
                        'email' => 'nicola.ceccagnoli.94@gmail.com',
                        'password' => 'password',
                    ],
                    [
                        'name' => 'Vincenzo',
                        'lastname' => 'Di Santo',
                        'birthday' => '1998-10-27',
                        'email' => 'vincenzods@gmail.com',
                        'password' => 'password',
                    ],
                    [
                        'name' => 'Riccardo',
                        'lastname' => 'Minei',
                        'birthday' => '2004-06-11',
                        'email' => 'mineiriccardo@gmail.com',
                        'password' => 'password',
                    ],
                    [
                        'name' => 'Alessio',
                        'lastname' => 'Romagnoli',
                        'birthday' => '2002-05-16',
                        'email' => 'alessio@gmail.com',
                        'password' => 'password',
                    ],
                    [
                        'name' => 'Checco',
                        'lastname' => 'Zalone',
                        'birthday' => '2005-04-18',
                        'email' => 'checcozalone@gmail.com',
                        'password' => 'password',
                    ]
                ];
        
                foreach ($allUsers as $singleUser) {
                    $user = User::create([
                        'name' => $singleUser['name'],
                        'lastname' => $singleUser['lastname'],
                        'birthday' => $singleUser['birthday'],
                        'email' => $singleUser['email'],
                        'password' => Hash::make($singleUser['password']),
                    ]);
                }
        }
    }
}