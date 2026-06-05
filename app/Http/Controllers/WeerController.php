<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeerController extends Controller
{
     public function dashboard()
    {
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

        // Zomer = juni + juli + augustus
        $totaleNeerslagSeizoen =
            $neerslag['juni'] +
            $neerslag['juli'] +
            $neerslag['augustus'];

        $seizoen = 'Zomer';

        $grenswaarde = 260;

        if ($totaleNeerslagSeizoen >= $grenswaarde) {
            $overstromingsgevaar = 'Hoog';
        } else {
            $overstromingsgevaar = 'Laag';
        }

        return view('technieker.weer', compact(
            'jaar',
            'seizoen',
            'totaleNeerslagSeizoen',
            'grenswaarde',
            'overstromingsgevaar'
        ));
    }
}
