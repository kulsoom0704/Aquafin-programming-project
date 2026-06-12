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
    // Toon alle materialen
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

    // Toon het formulier om een nieuw artikel toe te voegen
    public function create()
    {
        return view('materiaal.create');
    }

    // Sla het nieuwe artikel op of verhoog de voorraad
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

    // Toon het formulier voor een nieuwe levering
    public function leveringCreate()
    {
        $materialen = Materiaal::all();
        return view('materiaal.levering', compact('materialen'));
    }

    // Sla de uitgifte op en verminder de voorraad
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

    // Toon het formulier voor een retour
    public function retourCreate()
    {
        $materialen = Materiaal::all();
        return view('materiaal.retour', compact('materialen'));
    }

    // Sla de retour op en verhoog de voorraad
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

        return redirect('/materiaal?sectie=retours')->with('succes', 'Retour geregistreerd!');
    }

    // Upload foto voor een artikel
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

    // Verwijder foto van een artikel
    public function fotoVerwijderen($id)
    {
        $materiaal = Materiaal::find($id);
        $materiaal->foto = null;
        $materiaal->save();

        return redirect('/materiaal')->with('succes', 'Foto verwijderd!');
    }

    // =====================================================================
    // API voor slimme zoekbalk (Type Bol.com) - Aangeroepen via AJAX
    // =====================================================================
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

    // =====================================================================
    // FUNCTIES VOOR BESTELLINGEN (TECHNIEKER & MAGAZIJNIER)
    // =====================================================================

    // 1. Technieker bevestigt de bestelling
    public function bestellingOpslaan(Request $request)
    {
        $cart = json_decode($request->cart_data, true);

        if (!$cart || count($cart) === 0) {
            return redirect()->back()->with('error', 'Winkelwagen is leeg.');
        }

        // Tijdelijk foreign key-constraints uitschakelen voor bulkbestellingen
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        // Controleer of er een geldig gebruiker-ID is
        $userId = \Illuminate\Support\Facades\Auth::id();
        if (!$userId) {
            $eersteUser = \App\Models\User::first();
            $userId = $eersteUser ? $eersteUser->id : 1;
        }

        foreach ($cart as $item) {
            \App\Models\Bestelling::create([
                'user_id' => $userId, 
                'onderdeel_id' => $item['id'],
                'aantal' => $item['aantal'],
                'status' => 'in afwachting'
            ]);
        }

        // Herstel de foreign key-constraints na het opslaan
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        return redirect()->back()->with('success', 'Bestelling succesvol geplaatst! Je kan de status volgen in je historiek.');
    }
    // 2. Magazijnier bekijkt bestellingen om klaar te zetten
    public function magazijnierIndex()
    {
        // Alleen bestellingen met status 'in afwachting' ophalen
        $bestellingen = Bestelling::with(['materiaal'])
            ->where('status', 'in afwachting')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('magazijnier.bestellingen', compact('bestellingen'));
    }

    // 3. Magazijnier zet bestelling op klaargezet
    public function klaarzetten($id)
    {
        $bestelling = Bestelling::findOrFail($id);
        $bestelling->status = 'klaargezet';
        $bestelling->save();

        // Voorraad daadwerkelijk verminderen bij het klaarmaken
        if($bestelling->materiaal) {
            $bestelling->materiaal->beschikbaar -= $bestelling->aantal;
            $bestelling->materiaal->save();
        }

        return redirect()->back()->with('success', 'Bestelling succesvol klaargezet!');
    }

    // 4. Technieker bekijkt zijn bestelhistoriek
    public function techniekerHistoriek()
    {
        $bestellingen = Bestelling::with('materiaal')
            ->where('user_id', Auth::id() ?? 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('technieker.historiek', compact('bestellingen'));
    }

    
}