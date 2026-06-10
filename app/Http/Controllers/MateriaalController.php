<?php

namespace App\Http\Controllers;

use App\Models\Materiaal;
use App\Models\Levering;
use App\Models\Retour;
use App\Models\Melding;
use Illuminate\Http\Request;

class MateriaalController extends Controller
{
    // Toon alle materialen
    public function index(Request $request)
    {
        $zoekterm = $request->zoekterm;

        if ($zoekterm) {
            $materialen = Materiaal::where('artikelnummer', 'like', '%' . $zoekterm . '%')
                ->orWhere('omschrijving', 'like', '%' . $zoekterm . '%')
                ->orWhere('locatie', 'like', '%' . $zoekterm . '%')
                ->get();
        } else {
            $materialen = Materiaal::all();
        }

        $meldingen = Melding::orderBy('gelezen', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('materiaal.index', compact('materialen', 'zoekterm', 'meldingen'));
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
            'foto'          => 'nullable|image|max:2048',
        ], [
            'artikelnummer.required' => 'Artikelnummer is verplicht.',
            'omschrijving.required'  => 'Omschrijving is verplicht.',
            'locatie.required'       => 'Locatie is verplicht.',
            'beschikbaar.required'   => 'Beschikbaar is verplicht.',
            'beschikbaar.integer'    => 'Beschikbaar moet een getal zijn.',
            'beschikbaar.min'        => 'Beschikbaar moet minimaal 1 zijn.',
            'foto.image'             => 'Het bestand moet een afbeelding zijn.',
            'foto.max'               => 'De foto mag maximaal 2MB zijn.',
        ]);

        $fotopad = null;
        if ($request->hasFile('foto')) {
            $fotopad = $request->file('foto')->store('fotos', 'public');
        }

        $materiaal = Materiaal::where('artikelnummer', $request->artikelnummer)->first();

        if ($materiaal) {
            $materiaal->beschikbaar += $request->beschikbaar;
            if ($fotopad) {
                $materiaal->foto = $fotopad;
            }
            $materiaal->save();
        } else {
            Materiaal::create([
                'artikelnummer' => $request->artikelnummer,
                'omschrijving'  => $request->omschrijving,
                'locatie'       => $request->locatie,
                'beschikbaar'   => $request->beschikbaar,
                'foto'          => $fotopad,
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

        Levering::create([
            'materiaal_id' => $request->materiaal_id,
            'aantal'       => $request->aantal,
        ]);

        $materiaal = Materiaal::find($request->materiaal_id);
        $materiaal->beschikbaar += $request->aantal;
        $materiaal->save();

        return redirect('/materiaal?sectie=leveringen')->with('succes', 'Levering geregistreerd!');
    }

    // Toon het formulier voor een retour
    public function retourCreate()
    {
        $materialen = Materiaal::all();
        return view('materiaal.retour', compact('materialen'));
    }

    // Sla de retour op en verminder de voorraad
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

        Retour::create([
            'materiaal_id' => $request->materiaal_id,
            'aantal'       => $request->aantal,
        ]);

        $materiaal = Materiaal::find($request->materiaal_id);
        $materiaal->beschikbaar -= $request->aantal;
        $materiaal->save();

        return redirect('/materiaal?sectie=retours')->with('succes', 'Retour geregistreerd!');
    }

    // Upload foto voor een artikel
    public function fotoUpload(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|max:2048',
        ], [
            'foto.required' => 'Kies een foto.',
            'foto.image'    => 'Het bestand moet een afbeelding zijn.',
            'foto.max'      => 'De foto mag maximaal 2MB zijn.',
        ]);

        $materiaal = Materiaal::find($id);
        $fotopad = $request->file('foto')->store('fotos', 'public');
        $materiaal->foto = $fotopad;
        $materiaal->save();

        return redirect('/materiaal')->with('succes', 'Foto opgeslagen!');
    }

    // Verwijder foto van een artikel
    public function fotoVerwijderen($id)
    {
        $materiaal = Materiaal::find($id);
        $materiaal->foto = null;
        $materiaal->save();

        return redirect('/materiaal')->with('succes', 'Foto verwijderd!');
    }
}