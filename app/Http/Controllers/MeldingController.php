<?php

namespace App\Http\Controllers;

use App\Models\Melding;

class MeldingController extends Controller
{
    // Toon alle meldingen
    public function index()
    {
        $meldingen = Melding::where('gearchiveerd', false)
            ->orderBy('gelezen', 'asc')
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

        return redirect('/materiaal?sectie=meldingen');
    }

    // Markeer melding als ongelezen
    public function ongelezen($id)
    {
        $melding = Melding::find($id);
        $melding->gelezen = false;
        $melding->save();

        return redirect('/materiaal?sectie=meldingen');
    }

    // Archiveer melding
    public function archiveren($id)
    {
        $melding = Melding::find($id);
        $melding->gearchiveerd = true;
        $melding->save();

        return redirect('/materiaal?sectie=meldingen');
    }

    // Zet melding terug uit archief
    public function terugzetten($id)
    {
        $melding = Melding::find($id);
        $melding->gearchiveerd = false;
        $melding->save();

        return redirect('/materiaal?sectie=archief');
    }
}