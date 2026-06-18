<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Onderdeel;

// WeerController haalt weersgegevens op via de Open-Meteo API
// en bepaalt op basis daarvan het overstromingsrisico en aanbevolen materialen.

class WeerController extends Controller
{
public function dashboard(){
    // Zet de taal van Carbon naar Nederlands voor de weergave van weekdagen.
        \Carbon\Carbon::setLocale('nl');
    try {

        $jaar = 2025;
 // Historische neerslaggegevens die gebruikt worden voor seizoensanalyse.
        $neerslag = [
            'januari' => 72,
            'februari' => 62,
            'maart' => 70,
            'april' => 55,
            'mei' => 68,
            'juni' => 74,
            'juli' => 85,
            'augustus' => 79,
            'september' => 71,
            'oktober' => 90,
            'november' => 94,
            'december' => 108,
        ];
// Berekent de totale neerslag voor het zomerseizoen.
        $totaleNeerslagSeizoen =
            $neerslag['juni'] +
            $neerslag['juli'] +
            $neerslag['augustus'];

        $seizoen = 'Zomer';
        // Referentiewaarde voor de beoordeling van het risico.
        $grenswaarde = 260;
        
         // Haalt de weersvoorspelling op via de Open-Meteo API.
        $response = Http::withoutVerifying()
    ->timeout(10)
    ->retry(3, 1000)
    ->get(
        'https://api.open-meteo.com/v1/forecast',
        [
            'latitude' => 50.85,
            'longitude' => 4.35,
            'daily' => 'precipitation_sum',
            'forecast_days' => 3,
            'timezone' => 'Europe/Brussels'
        ]
    );

    $data = $response->json();
    // Controleert of de API succesvol heeft geantwoord.
    if (!$response->successful()) {
        throw new \Exception('API niet bereikbaar');
    }

    $voorspellingen = [];
    // Haalt de neerslaggegevens van de komende dagen op.
    $dagen = $data['daily']['time'];
    $neerslagWaarden = $data['daily']['precipitation_sum'];

    // Totale verwachte neerslag uit API
    $totaalVerwachteNeerslag = array_sum($neerslagWaarden);
     // Bepaalt het overstromingsgevaar op basis van de voorspelde neerslag.
    if ($totaalVerwachteNeerslag >= 20) {
        $overstromingsgevaar = 'Hoog';
    } elseif ($totaalVerwachteNeerslag >= 10) {
        $overstromingsgevaar = 'Gemiddeld';
    } else {
        $overstromingsgevaar = 'Laag';
    }

    // Selecteert aanbevolen materialen afhankelijk van het risico.
 if ($overstromingsgevaar == 'Hoog') {

    $kritiekeMaterialen = Onderdeel::whereIn('naam', [
        'Hydraulische Pomp XL',
        'Rubber Dichting 40mm'
    ])->get();

} elseif ($overstromingsgevaar == 'Gemiddeld') {

    $kritiekeMaterialen = Onderdeel::whereIn('naam', [
        'Rubber Dichting 40mm',
        'Oliefilter Type B'
    ])->get();

} else {
 // Bij laag risico worden alle materialen weergegeven.
    $kritiekeMaterialen = Onderdeel::all();
}

// Zet de API-gegevens om naar een overzichtelijke voorspelling per dag.
foreach ($dagen as $index => $datum) {

    $voorspellingen[] = [
        'dag' => \Carbon\Carbon::parse($datum)->translatedFormat('l'),
        'neerslag' => $neerslagWaarden[$index]
    ];
    }
    // Stuurt alle gegevens door naar de weerpagina.
        return view('technieker.weer', compact(
            'jaar',
            'seizoen',
            'totaleNeerslagSeizoen',
            'grenswaarde',
            'overstromingsgevaar',
            'voorspellingen',
            'kritiekeMaterialen',
            'totaalVerwachteNeerslag',
        ));
        } 
    catch (\Exception $e) {

    // Toont een foutmelding wanneer de weerservice niet bereikbaar is.
        return view('technieker.weer', [
            'foutmelding' => 'Geen weersgegevens beschikbaar.'
        ]);

    }
}
}
    

