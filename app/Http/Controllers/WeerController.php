<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Onderdeel;

class WeerController extends Controller
{
public function dashboard(){
        \Carbon\Carbon::setLocale('nl');
    try {

        $jaar = 2025;

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

        $totaleNeerslagSeizoen =
            $neerslag['juni'] +
            $neerslag['juli'] +
            $neerslag['augustus'];

        $seizoen = 'Zomer';
        $grenswaarde = 260;
        
        $response = Http::get(
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

$voorspellingen = [];

$dagen = $data['daily']['time'];
$neerslagWaarden = $data['daily']['precipitation_sum'];

// Totale verwachte neerslag uit API
$totaalVerwachteNeerslag = array_sum($neerslagWaarden);

if ($totaalVerwachteNeerslag >= 20) {
    $overstromingsgevaar = 'Hoog';
} elseif ($totaalVerwachteNeerslag >= 10) {
    $overstromingsgevaar = 'Gemiddeld';
} else {
    $overstromingsgevaar = 'Laag';
}

    // Kritieke materialen bepalen
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

    $kritiekeMaterialen = Onderdeel::all();
}

    
foreach ($dagen as $index => $datum) {

    $voorspellingen[] = [
        'dag' => \Carbon\Carbon::parse($datum)->translatedFormat('l'),
        'neerslag' => $neerslagWaarden[$index]
    ];
    }
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
         } catch (\Exception $e) {

        return view('technieker.weer', [
            'foutmelding' => 'Geen weersgegevens beschikbaar.'
        ]);

    }
}
}
    

