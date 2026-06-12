<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installatie;
use App\Models\Melding;
use App\Models\Notitie;
use App\Models\User;
use App\Models\Bestelling;
use App\Models\Materiaal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class InstallatieController extends Controller
{
    private function getSessieGebruikerId() {
        return session('gebruiker_id', 1);
    }

    // =======================================================
    // De slimme weerengine (demo-drempels)
    // =======================================================
    private function getWeerData() {
        try {
            $response = Http::withoutVerifying()
                ->timeout(5)
                ->retry(2, 500)
                ->get('https://api.open-meteo.com/v1/forecast', [
                    'latitude' => 50.85,
                    'longitude' => 4.35,
                    'current_weather' => true,
                    'daily' => 'precipitation_sum',
                    'timezone' => 'Europe/Brussels',
                    'forecast_days' => 3
                ]);

            if (!$response->successful()) throw new \Exception('API Error');

            $data = $response->json();
            $neerslagWaarden = $data['daily']['precipitation_sum'] ?? [0];
            $totaalNeerslag = array_sum($neerslagWaarden);
            $temp = $data['current_weather']['temperature'] ?? 15;
            $code = $data['current_weather']['weathercode'] ?? 0;

            // Risicoanalyse
            $gevaar = 'Laag';
            if ($totaalNeerslag >= 20) $gevaar = 'Kritiek';
            elseif ($totaalNeerslag >= 10) $gevaar = 'Gemiddeld';

            // Dynamische artikelselectie op basis van weer
            $aanbevolen_refs = [];
            
            // 🟢 Drempels aangepast voor veilige weergave
            // Bij regen wordt extra beschermingsmateriaal aanbevolen
            if ($gevaar == 'Kritiek' || $gevaar == 'Gemiddeld' || $totaalNeerslag > 0) {
                // Regen/overstroming: pompen, regenuitrusting, slangen
                $aanbevolen_refs = array_merge($aanbevolen_refs, ['AQF-006', 'PBM-008', 'TEC-005', 'PBM-007']);
            }
            
            // Bij warm en zonnig weer: veiligheidsbril
            if ($temp > 15 && $code <= 3) {
                // Hitte/Zon: bril
                $aanbevolen_refs = array_merge($aanbevolen_refs, ['PBM-003']);
            }
            
            // Bij koude of sneeuw aanpassen
            if ($temp < 5 || $code >= 71) {
                // Koude/sneeuw: thermische handschoenen, warme kleding
                $aanbevolen_refs = array_merge($aanbevolen_refs, ['PBM-005', 'PBM-010']);
            }

            return [
                'is_beschikbaar' => true,
                'temp' => $temp,
                'code' => $code,
                'neerslag' => $totaalNeerslag,
                'gevaar' => $gevaar,
                'aanbevolen_refs' => array_unique($aanbevolen_refs)
            ];

        } catch (\Exception $e) {
            return ['is_beschikbaar' => false, 'aanbevolen_refs' => []];
        }
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

            // On capte la météo pour le Dashboard des meldingen
            $weer = $this->getWeerData();

            return view('technieker.meldingen', compact('meldingen', 'huidigeTechnieker', 'weer'));

        } catch (\Exception $e) {
            return view('technieker.meldingen', [
                'meldingen' => collect(),
                'error' => 'Fout bij het ophalen van de installaties.',
                'weer' => ['is_beschikbaar' => false]
            ]);
        }
    }

    public function showBestelformulier()
    {
        $materialen = Materiaal::all();
        // Haal weerdata op voor webshopaanbevelingen
        $weer = $this->getWeerData();
        return view('technieker.bestellen', compact('materialen', 'weer'));
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