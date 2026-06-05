<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Installatie;
use Carbon\Carbon;

class InstallatieSeeder extends Seeder
{
    public function run(): void
    {
        $installaties = [
            //  Lukas (ID 1)
            ['naam' => 'Hoofdpomp 1', 'locatie' => 'Zone Noord', 'dagen_geleden' => 10, 'interval' => 365, 'technieker' => 1], // OK
            ['naam' => 'Klep Zuivering', 'locatie' => 'Zone Zuid', 'dagen_geleden' => 400, 'interval' => 365, 'technieker' => 1], // ALERTE
            
            // Emma (ID 2)
            ['naam' => 'Nieuwe Filter', 'locatie' => 'Zone Oost', 'dagen_geleden' => null, 'interval' => 180, 'technieker' => 2], // ALERTE
            ['naam' => 'Slibverwerker A', 'locatie' => 'Zone West', 'dagen_geleden' => 200, 'interval' => 180, 'technieker' => 2], // ALERTE
            ['naam' => 'Noodgenerator', 'locatie' => 'Hoofdgebouw', 'dagen_geleden' => 50, 'interval' => 90, 'technieker' => 2], // OK
            
            // Thomas (ID 3)
            ['naam' => 'Waterkwaliteit Sensor', 'locatie' => 'Bassin 1', 'dagen_geleden' => 35, 'interval' => 30, 'technieker' => 3], // ALERTE
            ['naam' => 'Beluchtingsmotor', 'locatie' => 'Bassin 2', 'dagen_geleden' => 100, 'interval' => 180, 'technieker' => 3], // OK
            ['naam' => 'Afvoerbuis Pomp', 'locatie' => 'Zone Zuid', 'dagen_geleden' => 700, 'interval' => 365, 'technieker' => 3], // ALERTE
        ];

        foreach ($installaties as $inst) {
            Installatie::create([
                'naam' => $inst['naam'],
                'locatie' => $inst['locatie'],
                'laatste_onderhoud_datum' => $inst['dagen_geleden'] === null ? null : Carbon::now()->subDays($inst['dagen_geleden']),
                'onderhoudsinterval_dagen' => $inst['interval'],
                'technieker_id' => $inst['technieker'] 
            ]);
        }
    }
}