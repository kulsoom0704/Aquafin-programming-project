<?php

namespace App\Http\Controllers;

use App\Models\Materiaal;
use App\Models\Levering;
use App\Models\Retour;
use App\Models\Melding;
use App\Models\Bestelling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriaalController extends Controller
{
    public function index(Request $request)
    {
        $zoekterm = $request->zoekterm;

        if ($zoekterm) {
            $zoektermLower = strtolower(trim($zoekterm));

            $materialen = Materiaal::all()->filter(function($item) use ($zoektermLower) {
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
        ], [
            'technieker_naam.required' => 'Naam technieker is verplicht.',
            'materiaal_id.required'    => 'Kies minstens één artikel.',
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
        ], [
            'technieker_naam.required' => 'Naam technieker is verplicht.',
            'materiaal_id.required'    => 'Kies minstens één artikel.',
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

        if ($request->bestelling_id) {
            $bestelling = Bestelling::find($request->bestelling_id);
            if ($bestelling) {
                $bestelling->status = 'geretourneerd';
                $bestelling->save();
            }
        }

        return redirect('/materiaal?sectie=retours')->with('succes', 'Retour geregistreerd!');
    }

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
            return response()->json([
                'bedoelde_je' => null,
                'artikelen' => Materiaal::all()
            ]);
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
            
            if (str_contains($naam, $doelwit) || str_contains($ref, $doelwit)) {
                return true;
            }

            $woorden = explode(' ', $naam);
            if (count($woorden) > 0 && levenshtein($doelwit, $woorden[0]) <= 2) {
                return true;
            }

            return false;
        });

        return response()->json([
            'bedoelde_je' => $queryIsCorrected ? $doelwit : null,
            'artikelen' => $resultaten->values()
        ]);
    }

    public function magazijnSearchLogic(Request $request)
    {
        $query = strtolower(trim($request->query('q', '')));

        if (strlen($query) < 1) {
            return response()->json(['artikelen' => Materiaal::all()]);
        }

        $materialen = Materiaal::all();

        $resultaten = $materialen->filter(function($item) use ($query) {
            $naam = strtolower($item->omschrijving);
            $ref = strtolower($item->artikelnummer);

            if (str_contains($naam, $query) || str_contains($ref, $query)) {
                return true;
            }

            $woorden = explode(' ', $naam);
            foreach ($woorden as $woord) {
                if (strlen($woord) > 2 && levenshtein($query, $woord) <= 2) {
                    return true;
                }
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

        if (!$bestelling) {
            return response()->json(['gevonden' => false]);
        }

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

        $userId = Auth::id();
        if (!$userId) {
            $eersteUser = \App\Models\User::first();
            $userId = $eersteUser ? $eersteUser->id : 1;
        }

        foreach ($cart as $item) {
            $materiaal = Materiaal::find($item['id']);

            if (!$materiaal || $materiaal->beschikbaar < $item['aantal']) {
                return redirect()->back()->with('error', "Niet genoeg voorraad voor {$item['naam']}!");
            }

            Bestelling::create([
                'user_id'     => $userId,
                'onderdeel_id' => null,
                'materiaal_id' => $item['id'],
                'aantal'      => $item['aantal'],
                'status'      => 'in afwachting'
            ]);

            $materiaal->beschikbaar -= $item['aantal'];
            $materiaal->save();
        }

        return redirect()->back()->with('success', 'Bestelling succesvol geplaatst! Voorraad is bijgewerkt.');
    }

    public function magazijnierIndex()
    {
        $bestellingen = Bestelling::with(['materiaal', 'user'])
            ->where('status', 'in afwachting')
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
        $gebruiker_id = session('gebruiker_id', 1);

        $bestellingen = Bestelling::with('materiaal')
            ->where('user_id', $gebruiker_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('technieker.historiek', compact('bestellingen'));
    }
}