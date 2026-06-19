<?php

namespace App\Http\Controllers;

use App\Models\Materiaal;
use App\Models\Levering;
use App\Models\Retour;
use App\Models\Melding;
use App\Models\Bestelling;
use App\Models\Voorraad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriaalController extends Controller
{
    public function index(Request $request)
    {
        $zoekterm = $request->zoekterm;
        $mijnDepot = session('depot', 'Antwerpen');

        $allMaterialen = Materiaal::with(['voorraden' => function($q) use ($mijnDepot) {
            $q->where('depot_naam', $mijnDepot);
        }])->get()->map(function($item) {
            $voorraad = $item->voorraden->first();
            $item->beschikbaar = $voorraad ? $voorraad->beschikbaar : 0;
            return $item;
        });

        if ($zoekterm) {
            $zoektermLower = strtolower(trim($zoekterm));

            $materialen = $allMaterialen->filter(function($item) use ($zoektermLower) {
                $artikelnummer = strtolower($item->artikelnummer);
                $omschrijving = strtolower($item->omschrijving);
                $locatie = strtolower($item->locatie);

                if (str_contains($artikelnummer, $zoektermLower) ||
                    str_contains($omschrijving, $zoektermLower) ||
                    str_contains($locatie, $zoektermLower)) {
                    return true;
                }

                $woorden = explode(' ', $omschrijving);
                foreach ($woorden as $woord) {
                    if (strlen($woord) > 2 && levenshtein($zoektermLower, $woord) <= 3) {
                            return true;
                    }
                }
                return false;
            })->values();
        } else {
            $materialen = $allMaterialen;
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
        $mijnDepot = session('depot', 'Antwerpen');

        if ($materiaal) {
            if ($fotopad) $materiaal->foto = $fotopad;
            $materiaal->save();
            
            $voorraad = Voorraad::firstOrCreate(
                ['materiaal_id' => $materiaal->id, 'depot_naam' => $mijnDepot],
                ['beschikbaar' => 0]
            );
            $voorraad->beschikbaar += $request->beschikbaar;
            $voorraad->save();

        } else {
            $nieuwMateriaal = Materiaal::create([
                'artikelnummer' => $request->artikelnummer,
                'omschrijving'  => $request->omschrijving,
                'locatie'       => $request->locatie,
                'beschikbaar'   => 0,
                'foto'          => $fotopad,
            ]);

            Voorraad::create([
                'materiaal_id' => $nieuwMateriaal->id,
                'depot_naam' => $mijnDepot,
                'beschikbaar' => $request->beschikbaar
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

        $mijnDepot = session('depot', 'Antwerpen');

        foreach ($request->materiaal_id as $index => $id) {
            if (!$id) continue;
            $aantal = $request->aantal[$index] ?? 1;
            Levering::create([
                'materiaal_id'    => $id,
                'aantal'          => $aantal,
                'technieker_naam' => $request->technieker_naam,
            ]);
            
            $voorraad = Voorraad::firstOrCreate(
                ['materiaal_id' => $id, 'depot_naam' => $mijnDepot],
                ['beschikbaar' => 0]
            );
            $voorraad->beschikbaar -= $aantal;
            $voorraad->save();
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

        $mijnDepot = session('depot', 'Antwerpen');

        foreach ($request->materiaal_id as $index => $id) {
            if (!$id) continue;

            $aantal = $request->aantal[$index] ?? 1;

            Retour::create([
                'materiaal_id'    => $id,
                'aantal'          => $aantal,
                'technieker_naam' => $request->technieker_naam,
            ]);

            $voorraad = Voorraad::firstOrCreate(
                ['materiaal_id' => $id, 'depot_naam' => $mijnDepot],
                ['beschikbaar' => 0]
            );
            $voorraad->beschikbaar += $aantal;
            $voorraad->save();
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

    public function searchLogic(Request $request)
    {
        $query = strtolower(trim($request->query('q', '')));
        if (strlen($query) < 2) {
            return response()->json(['bedoelde_je' => null, 'artikelen' => Materiaal::all()]);
        }
        $materialen = Materiaal::all();
        $thesaurus = [
            'schroef' => ['vis', 'viss', 'screw', 'shroef', 'vijz', 'schroof'],
            'bout' => ['boulon', 'boulons', 'bolt', 'bolts', 'bouten', 'boeten', 'bautton', 'button'],
            'helm' => ['casque', 'helmet', 'kask', 'helme', 'veiligheidshelm'],
            'handschoenen' => ['gant', 'gants', 'gloves', 'gans', 'handchoenen', 'handschoen'],
            'gereedschap' => ['outil', 'outils', 'tool', 'tools', 'geredschap'],
            'sleutel' => ['clef', 'clé', 'cle', 'key', 'slutel', 'moersleutel'],
            'tang' => ['pince', 'pliers', 'tange', 'kniptang'],
            'hamer' => ['marteau', 'hammer', 'amer'],
            'boormachine' => ['machine', 'perceuse', 'drill', 'bormachine', 'boor'],
            'pomp' => ['pompe', 'pump', 'pompen'],
            'bril' => ['lunettes', 'glasses', 'veiligheidsbril'],
            'pbm' => ['veiligheid', 'security', 'securite', 'bescherming']
        ];
        $doelwit = $query;
        $queryIsCorrected = false;
        foreach ($thesaurus as $officieel => $fouten) {
            if (in_array($query, $fouten) || levenshtein($query, $officieel) <= 1) {
                $doelwit = $officieel;
                $queryIsCorrected = true;
                break;
            }
        }
        $resultaten = $materialen->filter(function($item) use ($doelwit) {
            $naam = strtolower($item->omschrijving);
            $ref = strtolower($item->artikelnummer);
            if (str_contains($naam, $doelwit) || str_contains($ref, $doelwit)) return true;
            $woorden = explode(' ', $naam);
            if (count($woorden) > 0 && levenshtein($doelwit, $woorden[0]) <= 2) return true;
            return false;
        });
        return response()->json(['bedoelde_je' => $queryIsCorrected ? $doelwit : null, 'artikelen' => $resultaten->values()]);
    }

    public function magazijnSearchLogic(Request $request)
    {
        $query = strtolower(trim($request->query('q', '')));
        if (strlen($query) < 1) return response()->json(['artikelen' => Materiaal::all()]);
        $materialen = Materiaal::all();
        $resultaten = $materialen->filter(function($item) use ($query) {
            $naam = strtolower($item->omschrijving);
            $ref = strtolower($item->artikelnummer);
            if (str_contains($naam, $query) || str_contains($ref, $query)) return true;
            $woorden = explode(' ', $naam);
            foreach ($woorden as $woord) {
                if (strlen($woord) > 2 && levenshtein($query, $woord) <= 2) return true;
            }
            return false;
        });
        return response()->json(['artikelen' => $resultaten->values()]);
    }

    public function bestellingOpzoeken(Request $request)
    {
        $nummer = $request->query('nummer');
        $bestelling = Bestelling::with(['materiaal', 'user'])
            ->where('id', $nummer)
            ->where('status', 'klaargezet')
            ->first();
        if (!$bestelling) return response()->json(['gevonden' => false]);
        return response()->json([
            'gevonden' => true,
            'bestelling_id' => $bestelling->id,
            'materiaal_id' => $bestelling->materiaal->id ?? null,
            'omschrijving' => $bestelling->materiaal->omschrijving ?? '-',
            'aantal' => $bestelling->aantal,
            'technieker' => $bestelling->user->name ?? '-',
        ]);
    }

    public function bestellingOpslaan(Request $request)
{
    $cart = json_decode($request->cart_data, true);

    if (!$cart || count($cart) === 0) {
        return redirect()->back()->with('error', 'Winkelwagen is leeg.');
    }

    
    $userId = session('gebruiker_id', 1);
    $mijnDepot = session('depot', 'Antwerpen'); 

    foreach ($cart as $item) {
        $voorraad = Voorraad::where('materiaal_id', $item['id'])
                            ->where('depot_naam', $mijnDepot)
                            ->first();

        if (!$voorraad || $voorraad->beschikbaar < $item['aantal']) {
            return redirect()->back()->with('error', "Niet genoeg voorraad voor {$item['naam']} in depot {$mijnDepot}!");
        }

        Bestelling::create([
            'user_id'      => $userId,
            'onderdeel_id' => null,
            'materiaal_id' => $item['id'],
            'aantal'       => $item['aantal'],
            'status'       => 'in afwachting',
            'depot'        => $mijnDepot 
        ]);

        $voorraad->beschikbaar -= $item['aantal'];
        $voorraad->save();
    }

    return redirect()->route('technieker.historiek')->with('success', 'Bestelling succesvol geplaatst!');
}

    public function magazijnierIndex()
    {
        $mijnDepot = session('depot', 'Antwerpen'); 

        $bestellingen = Bestelling::with(['materiaal', 'user'])
            ->where('status', 'in afwachting')
            ->where('depot', $mijnDepot) 
            ->orderBy('created_at', 'asc')
            ->get();

        return view('materiaal.index', compact('bestellingen'));
    }

    public function klaarzetten($id)
    {
        $bestelling = Bestelling::findOrFail($id);
        $bestelling->status = 'klaargezet';
        $bestelling->save();
        return redirect()->back()->with('success', 'Bestelling succesvol klaargezet!');
    }

    public function bestellingTerugzetten($id)
    {
        $bestelling = Bestelling::findOrFail($id);
        $bestelling->status = 'in afwachting';
        $bestelling->save();
        return redirect('/materiaal?sectie=meldingen')->with('succes', 'Bestelling teruggezet naar bestellingen!');
    }

   public function techniekerHistoriek()
{
    // Haal de technieker-ID op uit de sessie voor zijn bestelgeschiedenis
    $gebruiker_id = session('gebruiker_id', 1);
    
    $bestellingen = Bestelling::with('materiaal')
        ->where('user_id', $gebruiker_id)
        ->orderBy('created_at', 'desc')
        ->get();
        
    return view('technieker.historiek', compact('bestellingen'));
}

    public function helpdesk()
    {
        // Toon alleen helpdeskverzoeken die voor de magazijnier zijn bedoeld
        $oproepen = \App\Models\Noodoproep::with('technieker')
            ->where('type', 'Magazijnier')
            ->orderByRaw("status = 'open' DESC")
            ->latest()
            ->get();
        return view('materiaal.helpdesk', compact('oproepen')); // Gebruik admin/helpdesk.blade.php als basis voor deze pagina
    }

   public function showHelpdesk($id)
    {
        $oproep = \App\Models\Noodoproep::with(['technieker', 'berichten'])->findOrFail($id);
        
        \App\Models\ChatBericht::where('noodoproep_id', $id)
            ->where('afzender_rol', 'Technieker')
            ->update(['gelezen' => true]);

        
        return view('materiaal.gesprek', compact('oproep')); 
    }

    public function verstuurBericht(Request $request, $id)
    {
        $request->validate(['bericht' => 'required']);
        
        \App\Models\ChatBericht::create([
            'noodoproep_id' => $id,
            'afzender_rol' => 'Magazijnier',
            'bericht' => $request->bericht,
            'gelezen' => false
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->back();
    }

    public function sluitGesprek($id)
    {
        $oproep = \App\Models\Noodoproep::findOrFail($id);
        $oproep->status = 'gesloten';
        $oproep->save();
        return redirect('/materiaal/helpdesk');
    }
}