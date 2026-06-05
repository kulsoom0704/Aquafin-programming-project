<?php

namespace App\Http\Controllers;

use App\Models\Melding;

class MeldingController extends Controller
{
    // Toon alle meldingen
    public function index()
    {
        $meldingen = Melding::orderBy('gelezen', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('melding.index', compact('meldingen'));
    }

    // Markeer melding als gelezen
    public function gelezen($id)
    {
        $melding = Melding::find($id);
        $melding->gelezen = true;
        $melding->save();

        return redirect('/meldingen');
    }

    // Markeer melding als ongelezen
    public function ongelezen($id)
    {
        $melding = Melding::find($id);
        $melding->gelezen = false;
        $melding->save();

        return redirect('/meldingen');
    }

    // Verwijder melding
    public function verwijderen($id)
    {
        $melding = Melding::find($id);
        $melding->delete();

        return redirect('/meldingen');
    }
}