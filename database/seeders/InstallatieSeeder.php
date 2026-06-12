<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Installatie;
use App\Models\Notitie;
use Carbon\Carbon;

class InstallatieSeeder extends Seeder
{
    public function run(): void
    {
        $installaties = [
            // 👤 Lukas (ID 1)
            [
                'naam' => 'Hoofdpomp 1', 
                'locatie' => 'Zone Noord', 
                'dagen_geleden' => 10, 
                'interval' => 365, 
                'technieker' => 1,
                'log' => 'Periodieke inspectie uitgevoerd. Smeersysteem bijgevuld en drukventielen getest. Status optimaal.'
            ],
            [
                'naam' => 'Klep Zuivering', 
                'locatie' => 'Zone Zuid', 
                'dagen_geleden' => 400, 
                'interval' => 365, 
                'technieker' => 1,
                'log' => 'Groot onderhoud uitgevoerd vorig jaar. Let op: mechanische slijtage geconstateerd bij de primaire afdichting.'
            ],
            
            // 👤 Emma (ID 2)
            [
                'naam' => 'Nieuwe Filter', 
                'locatie' => 'Zone Oost', 
                'dagen_geleden' => null, // ALERTE: Nooit onderhouden
                'interval' => 180, 
                'technieker' => 2,
                'log' => null
            ],
            [
                'naam' => 'Slibverwerker A', 
                'locatie' => 'Zone West', 
                'dagen_geleden' => 200, 
                'interval' => 180, 
                'technieker' => 2,
                'log' => 'Standaard revisie van de rotorbladen voltooid. Systeem herstart zonder foutmeldingen.'
            ],
            [
                'naam' => 'Noodgenerator', 
                'locatie' => 'Hoofdgebouw', 
                'dagen_geleden' => 50, 
                'interval' => 90, 
                'technieker' => 2,
                'log' => 'Maandelijkse opstarttest succesvol doorstaan. Accuspanning en brandstofpeil gecontroleerd.'
            ],
            
            // 👤 Thomas (ID 3)
            [
                'naam' => 'Waterkwaliteit Sensor', 
                'locatie' => 'Bassin 1', 
                'dagen_geleden' => 35, 
                'interval' => 30, 
                'technieker' => 3,
                'log' => 'Sensoren gekalibreerd met standaard testvloeistof. Afwijking gecorrigeerd naar 0.01%.'
            ],
            [
                'naam' => 'Beluchtingsmotor', 
                'locatie' => 'Bassin 2', 
                'dagen_geleden' => 100, 
                'interval' => 180, 
                'technieker' => 3,
                'log' => 'Lagers preventief vervangen om trillingen te verminderen. Motor loopt weer geruisloos.'
            ],
            [
                'naam' => 'Afvoerbuis Pomp', 
                'locatie' => 'Zone Zuid', 
                'dagen_geleden' => 700, 
                'interval' => 365, 
                'technieker' => 3,
                'log' => 'Algehele revisie van de behuizing uitgevoerd. Geen diepe corrosie aangetroffen.'
            ],
        ];

        foreach ($installaties as $inst) {
            // 1. Bereken de exacte onderhoudsdatum
            $onderhoudsDatum = $inst['dagen_geleden'] === null 
                ? null 
                : Carbon::now()->subDays($inst['dagen_geleden']);

            // 2. Maak de installatie aan
            $installatie = Installatie::create([
                'naam' => $inst['naam'],
                'locatie' => $inst['locatie'],
                'laatste_onderhoud_datum' => $onderhoudsDatum,
                'onderhoudsinterval_dagen' => $inst['interval'],
                'technieker_id' => $inst['technieker'] 
            ]);

            
            if ($onderhoudsDatum !== null && $inst['log'] !== null) {
                Notitie::create([
                    'installatie_id' => $installatie->id,
                    'user_id' => $inst['technieker'],
                    'opmerking' => $inst['log'],
                    'afbeelding' => null,
                    // We zetten de timestamps gelijk aan de onderhoudsdatum voor een realistische tijdlijn!
                    'created_at' => $onderhoudsDatum,
                    'updated_at' => $onderhoudsDatum,
                ]);
            }
        }
    }
}