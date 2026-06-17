<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installatie;
use App\Models\Melding;
use App\Models\Notitie;
use App\Models\User;
use App\Models\Onderdeel;  
use App\Models\Bestelling; 
use Carbon\Carbon;

class InstallatieController extends Controller
{
    private function getSessieGebruikerId() {
        return session('gebruiker_id', 1);
    }

    public function meldingen()
    {
        try {
            $actieveTechniekerId = $this->getSessieGebruikerId();
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
            
            $user = User::find($actieveTechniekerId);
            $huidigeTechnieker = $user ? $user->name : 'Technieker';

            return view('technieker.meldingen', compact('meldingen', 'huidigeTechnieker'));

        } catch (\Exception $e) {
            return view('technieker.meldingen', [
                'meldingen' => collect(),
                'error' => 'Er is een technische fout opgetreden bij het ophalen van de installaties.'
            ]);
        }
    }

    public function show($id)
    {
        $installatie = Installatie::with(['notities' => function($query) {
            $query->latest(); 
        }, 'notities.technieker'])->findOrFail($id);
        
        return view('technieker.logboek', compact('installatie'));
    }

    public function storeNotitie(Request $request, $id)
    {
        $request->validate([
            'opmerking' => 'required|string|min:3',
            'afbeelding' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);
        
        $installatie = Installatie::findOrFail($id);
        $imagePath = null;
        
        if ($request->hasFile('afbeelding')) {
            $imagePath = $request->file('afbeelding')->store('notities_images', 'public');
        }

        Notitie::create([
            'installatie_id' => $id,
            'user_id' => $this->getSessieGebruikerId(),
            'opmerking' => $request->opmerking,
            'afbeelding' => $imagePath 
        ]);
        
        $installatie->update([
            'laatste_onderhoud_datum' => Carbon::now()
        ]);
        
        return redirect()->route('installatie.show', $id)->with('success', 'Notitie succesvol toegevoegd en installatie bijgewerkt.');
    }

    
    public function valideren($id)
    {
        try {
            $installatie = Installatie::findOrFail($id);
            
            
            $installatie->update([
                'laatste_onderhoud_datum' => \Carbon\Carbon::now()
            ]);

            
            Melding::where('installatie_id', $id)->update(['status' => 'gelezen']);
            
            
            Notitie::create([
                'installatie_id' => $id,
                'user_id' => session('gebruiker_id', 1),
                'opmerking' => 'Systeem: Snelle validatie en visuele controle uitgevoerd via het dashboard.',
                'afbeelding' => null
            ]);
            
            return redirect()->back()->with('success', "Installatie '{$installatie->naam}' succesvol gevalideerd. De melding is opgelost!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het valideren van de installatie.');
        }
    }

    public function showBestelformulier()
    {
        $onderdelen = Onderdeel::all();
        $bestellingen = Bestelling::where('user_id', $this->getSessieGebruikerId())
                                  ->with('onderdeel')
                                  ->latest()
                                  ->get();

        return view('technieker.bestellen', compact('onderdelen', 'bestellingen'));
    }

    public function storeBestelling(Request $request)
    {
        $request->validate([
            'onderdeel_id' => 'required|exists:onderdelen,id',
            'aantal' => 'required|integer|min:1'
        ]);
        
        $onderdeel = Onderdeel::findOrFail($request->onderdeel_id);

        if ($onderdeel->voorraad < $request->aantal) {
            return redirect()->back()->with('error', "Bestelling mislukt: Er zijn slechts {$onderdeel->voorraad} stuks van '{$onderdeel->naam}' beschikbaar.");
        }

        Bestelling::create([
            'user_id' => $this->getSessieGebruikerId(),
            'onderdeel_id' => $onderdeel->id,
            'aantal' => $request->aantal,
            'status' => 'In behandeling' 
        ]);
        
        $onderdeel->decrement('voorraad', $request->aantal);
        
        return redirect()->back()->with('success', "Bestelling succesvol geregistreerd voor {$request->aantal}x {$onderdeel->naam}.");
    }

    public function historiek()
    {
        try {
            
            $notities = Notitie::with(['installatie', 'technieker'])
                ->latest()
                ->get();
                
            return view('technieker.historiek', compact('notities'));

        } catch (\Exception $e) {
            return view('technieker.historiek', [
                'notities' => collect(),
                'error' => 'Er is een fout opgetreden bij het laden van de historiek.'
            ]);
        }
    }

    public function storeNoodoproep(Request $request)
    {
        try {
            \App\Models\Noodoproep::create([
                'user_id' => session('gebruiker_id', 1), 
                'type' => $request->type,
                'bericht' => $request->bericht,
                'status' => 'open'
            ]);

            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}