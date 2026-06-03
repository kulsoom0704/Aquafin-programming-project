<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installatie;
use App\Models\Melding;
use App\Models\Notitie;
use App\Models\User;
use App\Models\Onderdeel;  // NIEUW: Geïmporteerd voor materiaalbestellingen
use App\Models\Bestelling; // NIEUW: Geïmporteerd voor materiaalbestellingen
use Carbon\Carbon;

class InstallatieController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User Story 1: Onderhoudsmeldingen Dashboard
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | User Story 2: Logboek (Detailpagina & Notities)
    |--------------------------------------------------------------------------
    */
    
    // Weergave van het installatieprofiel en de historiek
    public function show($id)
    {
        $installatie = Installatie::with(['notities' => function($query) {
            $query->latest(); 
        }, 'notities.technieker'])->findOrFail($id);

        return view('technieker.logboek', compact('installatie'));
    }

    // Validatie en opslag van een nieuwe interventienotitie
    public function storeNotitie(Request $request, $id)
    {
        $request->validate([
            'opmerking' => 'required|string|min:3'
        ]);

        $installatie = Installatie::findOrFail($id);

        Notitie::create([
            'installatie_id' => $id,
            'user_id' => 1, // Lukas
            'opmerking' => $request->opmerking
        ]);

        // Logische update: De laatste onderhoudsdatum wordt direct naar NU gezet
        $installatie->update([
            'laatste_onderhoud_datum' => Carbon::now()
        ]);

        return redirect()->route('installatie.show', $id)->with('success', 'Notitie succesvol toegevoegd en installatie bijgewerkt.');
    }

    /*
    |--------------------------------------------------------------------------
    | User Story 3: Materiaalbestellingen (Nieuw)
    |--------------------------------------------------------------------------
    */
    
    // Toon het bestelformulier met de beschikbare onderdelen en bestelhistoriek
    public function showBestelformulier()
    {
        $onderdelen = Onderdeel::all();
        $bestellingen = Bestelling::with('onderdeel')->latest()->get();

        return view('technieker.bestellen', compact('onderdelen', 'bestellingen'));
    }

    // Controleer de voorraad en registreer de bestelling
    public function storeBestelling(Request $request)
    {
        // 1. Gegevens valideren
        $request->validate([
            'onderdeel_id' => 'required|exists:onderdelen,id',
            'aantal' => 'required|integer|min:1'
        ]);

        $onderdeel = Onderdeel::findOrFail($request->onderdeel_id);

        // 2. Voorraad en beschikbaarheid controleren (Scenario 2)
        if ($onderdeel->voorraad < $request->aantal) {
            return redirect()->back()->with('error', "Bestelling mislukt: Er zijn slechts {$onderdeel->voorraad} stuks van '{$onderdeel->naam}' beschikbaar.");
        }

        // 3. Bestelling registreren (Scenario 1)
        Bestelling::create([
            'user_id' => 1, // Lukas
            'onderdeel_id' => $onderdeel->id,
            'aantal' => $request->aantal,
            'status' => 'In behandeling' // Status beheren
        ]);

        // 4. Voorraad fysiek verminderen in de database
        $onderdeel->decrement('voorraad', $request->aantal);

        return redirect()->back()->with('success', "Bestelling succesvol geregistreerd voor {$request->aantal}x {$onderdeel->naam}.");
    }
}