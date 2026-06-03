<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriaalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('materiaal')->insert([
            [
                'artikelnummer' => 'PMP-2045',
                'omschrijving'  => 'Industriële waterpomp 500W',
                'locatie'       => 'A-Rij 02',
                'beschikbaar'   => 12,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'artikelnummer' => 'FLT-9081',
                'omschrijving'  => 'Actieve koolstoffilter XL',
                'locatie'       => 'C-Rij 14',
                'beschikbaar'   => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'artikelnummer' => 'VLV-1182',
                'omschrijving'  => 'Kogelkraan PVC 50mm',
                'locatie'       => 'B-Rij 05',
                'beschikbaar'   => 45,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'artikelnummer' => 'SEN-3340',
                'omschrijving'  => 'Niveausensor ultrasoon',
                'locatie'       => 'D-Rij 01',
                'beschikbaar'   => 8,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}