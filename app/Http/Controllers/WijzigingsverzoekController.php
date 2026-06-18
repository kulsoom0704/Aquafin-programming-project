<?php

namespace App\Http\Controllers;

use App\Models\Wijzigingsverzoek;
use App\Models\Materiaal;
use App\Models\Melding;
use Illuminate\Http\Request;

// WijzigingsverzoekController beheert aanvragen van magazijniers
// om bestaande materialen te laten aanpassen door een administrator.

class WijzigingsverzoekController extends Controller
{
    // Toon het wijzigingsformulier
    public function create($id)
    {
        // Haalt het geselecteerde materiaal op.
        $materiaal = Materiaal::find($id);
        return view('materiaal.wijzigen', compact('materiaal'));
    }

    // Sla het wijzigingsverzoek op
    public function store(Request $request, $id)
    {
        // Controleert of alle verplichte gegevens correct zijn ingevuld.
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

        // Maakt een melding aan zodat de administrator het verzoek kan beoordelen.
        $materiaal = Materiaal::find($id);
        Melding::create([
            'titel'   => 'Wijzigingsverzoek van magazijnier',
            'bericht' => 'Magazijnier wil artikel ' . $materiaal->artikelnummer . ' wijzigen.',
            'gelezen' => false,
        ]);
    // Stuurt de gebruiker terug naar het materiaaloverzicht.
        return redirect('/materiaal')->with('succes', 'Wijzigingsverzoek ingediend! Wacht op goedkeuring van de admin.');
    }
}