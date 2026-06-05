<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeerController extends Controller
{
public function dashboard(){
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

        if ($totaleNeerslagSeizoen >= $grenswaarde) {
            $overstromingsgevaar = 'Hoog';
        } elseif ($totaleNeerslagSeizoen >= ($grenswaarde * 0.8)) {
            $overstromingsgevaar = 'Gemiddeld';
        } else {
            $overstromingsgevaar = 'Laag';
        }

        $voorspellingen = [
    [
        'dag' => 'Vrijdag',
        'neerslag' => 12
    ],
    [
        'dag' => 'Zaterdag',
        'neerslag' => 18
    ],
    [
        'dag' => 'Zondag',
        'neerslag' => 4
    ]
];
        return view('technieker.weer', compact(
            'jaar',
            'seizoen',
            'totaleNeerslagSeizoen',
            'grenswaarde',
            'overstromingsgevaar',
            'voorspellingen'
        ));

    } catch (\Exception $e) {

        return view('technieker.weer', [
            'foutmelding' =>
                'Geen weersgegevens beschikbaar.'
        ]);
    }
}
}