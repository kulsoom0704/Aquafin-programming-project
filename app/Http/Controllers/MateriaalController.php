<?php

namespace App\Http\Controllers;

use App\Models\Materiaal;
use App\Models\Levering;
use App\Models\Retour;
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

        $materiaal = Materiaal::where('artikelnummer', $request->artikelnummer)->first();

        if ($materiaal) {
            $materiaal->beschikbaar += $request->beschikbaar;
            $materiaal->save();
        } else {
            Materiaal::create([
                'artikelnummer' => $request->artikelnummer,
                'omschrijving'  => $request->omschrijving,
                'locatie'       => $request->locatie,
                'beschikbaar'   => $request->beschikbaar,
            ]);
        }

        return redirect('/materiaal');
    }

    // Toon het formulier voor een nieuwe levering
    public function leveringCreate()
    {
        $materialen = Materiaal::all();
        return view('materiaal.levering', compact('materialen'));
    }

    // Sla de nieuwe levering op en verhoog de voorraad
    public function leveringStore(Request $request)
    {
        $request->validate([
            'materiaal_id' => 'required',
            'aantal'       => 'required|integer|min:1',
        ], [
            'materiaal_id.required' => 'Kies een artikel.',
            'aantal.required'       => 'Aantal is verplicht.',
            'aantal.integer'        => 'Aantal moet een getal zijn.',
            'aantal.min'            => 'Aantal moet minimaal 1 zijn.',
        ]);

        // Sla levering op
        Levering::create([
            'materiaal_id' => $request->materiaal_id,
            'aantal'       => $request->aantal,
        ]);

        // Verhoog de voorraad
        $materiaal = Materiaal::find($request->materiaal_id);
        $materiaal->beschikbaar += $request->aantal;
        $materiaal->save();

        return redirect('/materiaal')->with('succes', 'Levering geregistreerd!');
    }

    // Toon het formulier voor een retour
    public function retourCreate()
    {
        $materialen = Materiaal::all();
        return view('materiaal.retour', compact('materialen'));
    }

    // Sla de retour op en verhoog de voorraad
    public function retourStore(Request $request)
    {
        $request->validate([
            'materiaal_id' => 'required',
            'aantal'       => 'required|integer|min:1',
        ], [
            'materiaal_id.required' => 'Kies een artikel.',
            'aantal.required'       => 'Aantal is verplicht.',
            'aantal.integer'        => 'Aantal moet een getal zijn.',
            'aantal.min'            => 'Aantal moet minimaal 1 zijn.',
        ]);

        // Sla retour op
        Retour::create([
            'materiaal_id' => $request->materiaal_id,
            'aantal'       => $request->aantal,
        ]);

        // Verhoog de voorraad
        $materiaal = Materiaal::find($request->materiaal_id);
        $materiaal->beschikbaar -= $request->aantal;
        $materiaal->save();

        return redirect('/materiaal')->with('succes', 'Retour geregistreerd!');
    }
}