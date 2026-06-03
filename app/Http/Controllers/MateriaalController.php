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

    // Sla het nieuwe artikel op in de database
    public function store(Request $request)
    {
        Materiaal::create([
            'artikelnummer' => $request->artikelnummer,
            'omschrijving'  => $request->omschrijving,
            'locatie'       => $request->locatie,
            'beschikbaar'   => $request->beschikbaar,
        ]);

        return redirect('/materiaal');
    }
}