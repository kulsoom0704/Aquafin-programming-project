<?php

namespace App\Http\Controllers;

use App\Models\Materiaal;
use App\Models\Levering;
use App\Models\Retour;
use App\Models\Melding;
use Illuminate\Http\Request;

class MateriaalController extends Controller
{
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

    public function create()
    {
        return view('materiaal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'artikelnummer' => 'required',
            'omschrijving'  => 'required',
            'locatie'       => 'required',
            'beschikbaar'   => 'required|integer|min:1',
            'foto'          => 'nullable|image|max:2048',
        ]);

        $fotopad = null;
        if ($request->hasFile('foto')) {
            $fotopad = $request->file('foto')->store('fotos', 'public');
        }

        $materiaal = Materiaal::where('artikelnummer', $request->artikelnummer)->first();

        if ($materiaal) {
            $materiaal->beschikbaar += $request->beschikbaar;
            if ($fotopad) $materiaal->foto = $fotopad;
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

    public function leveringCreate()
    {
        $materialen = Materiaal::all();
        return view('materiaal.levering', compact('materialen'));
    }

    public function leveringStore(Request $request)
    {
        $request->validate([
            'technieker_naam' => 'required',
            'materiaal_id'    => 'required|array',
            'aantal'          => 'required|array',
        ]);

        foreach ($request->materiaal_id as $index => $id) {
            if (!$id) continue;
            $aantal = $request->aantal[$index] ?? 1;
            Levering::create([
                'materiaal_id'    => $id,
                'aantal'          => $aantal,
                'technieker_naam' => $request->technieker_naam,
            ]);
            $materiaal = Materiaal::find($id);
            $materiaal->beschikbaar -= $aantal;
            $materiaal->save();
        }

        return redirect('/materiaal?sectie=leveringen')->with('succes', 'Uitgifte geregistreerd!');
    }

    public function retourCreate()
    {
        $materialen = Materiaal::all();
        return view('materiaal.retour', compact('materialen'));
    }

    public function retourStore(Request $request)
    {
        $request->validate([
            'technieker_naam' => 'required',
            'materiaal_id'    => 'required|array',
            'aantal'          => 'required|array',
        ]);

        foreach ($request->materiaal_id as $index => $id) {
            if (!$id) continue;
            $aantal = $request->aantal[$index] ?? 1;
            Retour::create([
                'materiaal_id'    => $id,
                'aantal'          => $aantal,
                'technieker_naam' => $request->technieker_naam,
            ]);
            $materiaal = Materiaal::find($id);
            $materiaal->beschikbaar += $aantal;
            $materiaal->save();
        }

        return redirect('/materiaal?sectie=retours')->with('succes', 'Retour geregistreerd!');
    }

    public function fotoUpload(Request $request, $id)
    {
        $request->validate(['foto' => 'required|image|max:2048']);
        $materiaal = Materiaal::find($id);
        $fotopad = $request->file('foto')->store('fotos', 'public');
        $materiaal->foto = $fotopad;
        $materiaal->save();
        return redirect('/materiaal')->with('succes', 'Foto opgeslagen!');
    }

    public function fotoVerwijderen($id)
    {
        $materiaal = Materiaal::find($id);
        $materiaal->foto = null;
        $materiaal->save();
        return redirect('/materiaal')->with('succes', 'Foto verwijderd!');
    }

    public function bestellingGoedkeuren(Request $request, $id)
    {
        $request->validate([
            'materiaal_id' => 'required|exists:materiaal,id',
        ]);

        $bestelling = \App\Models\Bestelling::findOrFail($id);
        $materiaal = Materiaal::findOrFail($request->materiaal_id);

        if ($materiaal->beschikbaar < $bestelling->aantal) {
            return redirect('/materiaal?sectie=meldingen')
                ->with('fout', "Niet genoeg voorraad! Beschikbaar: {$materiaal->beschikbaar}, Gevraagd: {$bestelling->aantal}");
        }

        $materiaal->beschikbaar -= $bestelling->aantal;
        $materiaal->save();

        $bestelling->status = 'Goedgekeurd';
        $bestelling->materiaal_id = $materiaal->id;
        $bestelling->save();

        return redirect('/materiaal?sectie=meldingen')->with('succes', 'Bestelling goedgekeurd en voorraad bijgewerkt!');
    }

    public function bestellingAfwijzen($id)
    {
        $bestelling = \App\Models\Bestelling::findOrFail($id);
        $onderdeel = \App\Models\Onderdeel::findOrFail($bestelling->onderdeel_id);
        $onderdeel->voorraad += $bestelling->aantal;
        $onderdeel->save();
        $bestelling->status = 'Afgewezen';
        $bestelling->save();
        return redirect('/materiaal?sectie=meldingen')->with('succes', 'Bestelling afgewezen.');
    }
}