<?php

namespace App\Http\Controllers;

use App\Models\Wijzigingsverzoek;
use App\Models\Materiaal;
use App\Models\Melding;
use Illuminate\Http\Request;

class WijzigingsverzoekController extends Controller
{
    // Toon het wijzigingsformulier
    public function create($id)
    {
        $materiaal = Materiaal::find($id);
        return view('materiaal.wijzigen', compact('materiaal'));
    }

    // Sla het wijzigingsverzoek op
    public function store(Request $request, $id)
    {
        $request->validate([
            'nieuw_artikelnummer' => 'required',
            'nieuwe_omschrijving' => 'required',
            'nieuwe_locatie'      => 'required',
            'nieuwe_beschikbaar'  => 'required|integer|min:0',
        ], [
            'nieuw_artikelnummer.required' => 'Artikelnummer is verplicht.',
            'nieuwe_omschrijving.required' => 'Omschrijving is verplicht.',
            'nieuwe_locatie.required'      => 'Locatie is verplicht.',
            'nieuwe_beschikbaar.required'  => 'Beschikbaar is verplicht.',
            'nieuwe_beschikbaar.integer'   => 'Beschikbaar moet een getal zijn.',
            'nieuwe_beschikbaar.min'       => 'Beschikbaar moet minimaal 0 zijn.',
        ]);

        // Sla wijzigingsverzoek op
        Wijzigingsverzoek::create([
            'materiaal_id'        => $id,
            'nieuw_artikelnummer' => $request->nieuw_artikelnummer,
            'nieuwe_omschrijving' => $request->nieuwe_omschrijving,
            'nieuwe_locatie'      => $request->nieuwe_locatie,
            'nieuwe_beschikbaar'  => $request->nieuwe_beschikbaar,
            'status'              => 'wachtend',
        ]);

        // Stuur melding naar admin
        $materiaal = Materiaal::find($id);
        Melding::create([
            'titel'   => 'Wijzigingsverzoek van magazijnier',
            'bericht' => 'Magazijnier wil artikel ' . $materiaal->artikelnummer . ' wijzigen.',
            'gelezen' => false,
        ]);

        return redirect('/materiaal')->with('succes', 'Wijzigingsverzoek ingediend! Wacht op goedkeuring van de admin.');
    }
}