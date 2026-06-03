<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installatie;
use App\Models\Melding;
use App\Models\Notitie;
use Carbon\Carbon;
use App\Models\User;

class InstallatieController extends Controller
{
    public function meldingen()
    {
        try {
            
            $actieveTechniekerId = 1;
            $installaties = Installatie::where('technieker_id', $actieveTechniekerId)->get();
            $meldingenLijst = collect(); 

            foreach ($installaties as $installatie) {
                $onderhoudNodig = false;
                $dagenTeLaat = 0;

                if ($installatie->laatste_onderhoud_datum) {
                    $volgendeOnderhoud = Carbon::parse($installatie->laatste_onderhoud_datum)->addDays($installatie->onderhoudsinterval_dagen);

                    if (Carbon::now()->greaterThanOrEqualTo($volgendeOnderhoud)) {
                        $onderhoudNodig = true;
                        $dagenTeLaat = (int) abs(Carbon::now()->diffInDays($volgendeOnderhoud));
                    }
                } else {
                    $onderhoudNodig = true;
                    $dagenTeLaat = 999;
                }

                if ($onderhoudNodig) {
                    $installatie->dagen_te_laat = $dagenTeLaat;
                    $meldingenLijst->push($installatie);

                    Melding::firstOrCreate(
                        ['installatie_id' => $installatie->id, 'status' => 'ongelezen'],
                        ['bericht' => 'Onderhoud vereist. Dagen overtijd: ' . $dagenTeLaat]
                    );
                }
            }

            $meldingen = $meldingenLijst->sortByDesc('dagen_te_laat');

            $huidigeTechnieker = User::find($actieveTechniekerId)->name;

            return view('technieker.meldingen', compact('meldingen', 'huidigeTechnieker'));

        } catch (\Exception $e) {
            return view('technieker.meldingen', [
                'meldingen' => collect(),
                'error' => 'Er is een technische fout opgetreden bij het ophalen van de installaties.'
            ]);
        }
    }

    // Fonction pour afficher le profil de la machine et son Logbook
    public function show($id)
    {
        // On cherche la machine avec ses notes (triées de la plus récente à la plus ancienne) et le nom des techniciens
        $installatie = Installatie::with(['notities' => function($query) {
            $query->latest(); 
        }, 'notities.technieker'])->findOrFail($id);

        return view('technieker.logboek', compact('installatie'));
    }

    public function storeNotitie(Request $request, $id)
    {
        $request->validate([
            'opmerking' => 'required|string|min:3'
        ]);

        
        Notitie::create([
            'installatie_id' => $id,
            'user_id' => 1,
            'opmerking' => $request->opmerking
        ]);

        return redirect()->route('installatie.show', $id)->with('success', 'Notitie succesvol toegevoegd aan het logboek.');
    }
}