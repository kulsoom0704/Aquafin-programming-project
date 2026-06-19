<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Onderdeel;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Technici
        User::create(['name' => 'Lukas Peeters', 'email' => 'lukas@aquafin.be', 'password' => Hash::make('password')]);
        User::create(['name' => 'Emma Claes', 'email' => 'emma@aquafin.be', 'password' => Hash::make('password')]);
        User::create(['name' => 'Thomas Maes', 'email' => 'thomas@aquafin.be', 'password' => Hash::make('password')]);

    
        $this->call([
            InstallatieSeeder::class,
            MateriaalSeeder::class, 
        ]);
    }
}