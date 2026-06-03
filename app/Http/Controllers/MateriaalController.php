<?php

namespace App\Http\Controllers;

use App\Models\Materiaal;
use Illuminate\Http\Request;

class MateriaalController extends Controller
{
    // Toon alle materialen
    public function index()
    {
        $materialen = Materiaal::all();
        return view('materiaal.index', compact('materialen'));
    }

    // Toon het formulier om een nieuw artikel toe te voegen
    public function create()
    {
        return view('materiaal.create');
    }

    // Sla het nieuwe artikel op of verhoog de voorraad
    public function store(Request $request)
    {
        // Validatie - alle velden zijn verplicht
        $request->validate([
            'artikelnummer' => 'required',
            'omschrijving'  => 'required',
            'locatie'       => 'required',
            'beschikbaar'   => 'required|integer|min:1',
        ], [
            'artikelnummer.required' => 'Artikelnummer is verplicht.',
            'omschrijving.required'  => 'Omschrijving is verplicht.',
            'locatie.required'       => 'Locatie is verplicht.',
            'beschikbaar.required'   => 'Beschikbaar is verplicht.',
            'beschikbaar.integer'    => 'Beschikbaar moet een getal zijn.',
            'beschikbaar.min'        => 'Beschikbaar moet minimaal 1 zijn.',
        ]);

        // Kijk of het artikel al bestaat
        $materiaal = Materiaal::where('artikelnummer', $request->artikelnummer)->first();

        if ($materiaal) {
            // Artikel bestaat al, verhoog de voorraad
            $materiaal->beschikbaar += $request->beschikbaar;
            $materiaal->save();
        } else {
            // Artikel bestaat niet, maak een nieuw aan
            Materiaal::create([
                'artikelnummer' => $request->artikelnummer,
                'omschrijving'  => $request->omschrijving,
                'locatie'       => $request->locatie,
                'beschikbaar'   => $request->beschikbaar,
            ]);
        }

        return redirect('/materiaal');
    }
}