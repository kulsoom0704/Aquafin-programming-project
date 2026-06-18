<?php

namespace App\Http\Controllers;

use App\Models\Materiaal;
use App\Models\Levering;
use App\Models\Retour;
use App\Models\Melding;
use App\Models\Bestelling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// MateriaalController beheert het magazijnsysteem,
// waaronder materialen, leveringen, retours, bestellingen en zoekfunctionaliteiten.

class MateriaalController extends Controller
{
    public function index(Request $request)
    {
        // Haalt de ingevoerde zoekterm op.
        $zoekterm = $request->zoekterm;

        if ($zoekterm) {
            $zoektermLower = strtolower(trim($zoekterm));
        // Zoekt materialen op basis van artikelnummer, omschrijving of locatie.
            $materialen = Materiaal::all()->filter(function($item) use ($zoektermLower) {
                $artikelnummer = strtolower($item->artikelnummer);
                $omschrijving = strtolower($item->omschrijving);
                $locatie = strtolower($item->locatie);

                if (str_contains($artikelnummer, $zoektermLower) ||
                    str_contains($omschrijving, $zoektermLower) ||
                    str_contains($locatie, $zoektermLower)) {
                    return true;
                }
            // Splitst de omschrijving op in afzonderlijke woorden.
                $woorden = explode(' ', $omschrijving);

            // Ondersteunt fouttolerant zoeken via Levenshtein-afstand.
            // Hierdoor worden kleine typfouten van de gebruiker opgevangen.
                foreach ($woorden as $woord) {
                    if (strlen($woord) > 2 && levenshtein($zoektermLower, $woord) <= 3) {
                            return true;
                    }
                }
            // Geen overeenkomst gevonden.
                return false;
            })->values();
        } else {
            // Indien geen zoekterm werd ingegeven,
    // worden alle materialen uit de databank opgehaald.
            $materialen = Materiaal::all();
        }
    // Haalt alle meldingen op en sorteert deze eerst op gelezen status
// en vervolgens van nieuwste naar oudste.
        $meldingen = Melding::orderBy('gelezen', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
    // Stuurt materialen, zoekterm en meldingen door naar de overzichtspagina.
        return view('materiaal.index', compact('materialen', 'zoekterm', 'meldingen'));
    }

    public function create()
    {
        // Opent het formulier voor het toevoegen van nieuw materiaal.
        return view('materiaal.create');
    }

    public function store(Request $request)
    {
        // Controleert of alle verplichte velden correct zijn ingevuld
    // voordat het materiaal wordt opgeslagen.
        $request->validate([
            'artikelnummer' => 'required',
            'omschrijving'  => 'required',
            'locatie'       => 'required',
            'beschikbaar'   => 'required|integer|min:1',
            'foto'          => 'nullable|image|max:2048',
        ], [
            // Aangepaste foutmeldingen die aan de gebruiker worden getoond
        // wanneer een validatieregel niet wordt nageleefd.
            'artikelnummer.required' => 'Artikelnummer is verplicht.',
            'omschrijving.required'  => 'Omschrijving is verplicht.',
            'locatie.required'       => 'Locatie is verplicht.',
            'beschikbaar.required'   => 'Beschikbaar is verplicht.',
            'beschikbaar.integer'    => 'Beschikbaar moet een getal zijn.',
            'beschikbaar.min'        => 'Beschikbaar moet minimaal 1 zijn.',
            'foto.image'             => 'Het bestand moet een afbeelding zijn.',
            'foto.max'               => 'De foto mag maximaal 2MB zijn.',
        ]);
// Standaard wordt er geen foto opgeslagen.
        $fotopad = null;

        // Controleert of de gebruiker een afbeelding heeft geüpload.
        if ($request->hasFile('foto')) {
            // Slaat de afbeelding op in de map 'fotos' binnen de publieke opslag.
            $fotopad = $request->file('foto')->store('fotos', 'public');
        }
        // Controleert of er reeds materiaal bestaat met hetzelfde artikelnummer.
        $materiaal = Materiaal::where('artikelnummer', $request->artikelnummer)->first();

        if ($materiaal) {
            // Indien het materiaal al bestaat, wordt de voorraad verhoogd.
            $materiaal->beschikbaar += $request->beschikbaar;
            // Werkt de foto bij indien een nieuwe afbeelding werd geüpload.
            if ($fotopad) {
                $materiaal->foto = $fotopad;
            }
            // Slaat de gewijzigde gegevens op.
            $materiaal->save();
        } else {
            Materiaal::create([
                // Indien het materiaal nog niet bestaat,
                // wordt een nieuw materiaalrecord aangemaakt.
                'artikelnummer' => $request->artikelnummer,
                'omschrijving'  => $request->omschrijving,
                'locatie'       => $request->locatie,
                'beschikbaar'   => $request->beschikbaar,
                'foto'          => $fotopad,
            ]);
        }
    // Keert terug naar het materiaaloverzicht.
        return redirect('/materiaal');
    }

    public function leveringCreate()
    {
        // Haalt alle beschikbare materialen op voor het uitgifteformulier.
        $materialen = Materiaal::all();
        return view('materiaal.levering', compact('materialen'));
    }

    public function leveringStore(Request $request)
    {
        // Controleert of alle verplichte gegevens correct werden ingevuld.
        $request->validate([
            'technieker_naam' => 'required',
            'materiaal_id'    => 'required|array',
            'aantal'          => 'required|array',
        ], [
            'technieker_naam.required' => 'Naam technieker is verplicht.',
            'materiaal_id.required'    => 'Kies minstens één artikel.',
        ]);
// Registreert de uitgifte van materialen aan een technieker.
        foreach ($request->materiaal_id as $index => $id) {
            if (!$id) continue;

            $aantal = $request->aantal[$index] ?? 1;

            Levering::create([
                'materiaal_id'    => $id,
                'aantal'          => $aantal,
                'technieker_naam' => $request->technieker_naam,
            ]);
    // Vermindert automatisch de voorraad van het uitgegeven materiaal.
            $materiaal = Materiaal::find($id);
            $materiaal->beschikbaar -= $aantal;
            $materiaal->save();
        }
// Keert terug naar het leveringenoverzicht met een succesmelding.
        return redirect('/materiaal?sectie=leveringen')->with('succes', 'Uitgifte geregistreerd!');
    }

    public function retourCreate()
    {
        // Haalt alle beschikbare materialen op voor het retourformulier.
        $materialen = Materiaal::all();
        return view('materiaal.retour', compact('materialen'));
    }

    public function retourStore(Request $request)
    {
        // Controleert of alle verplichte gegevens correct werden ingevuld.
        $request->validate([
            'technieker_naam' => 'required',
            'materiaal_id'    => 'required|array',
            'aantal'          => 'required|array',
        ], [
            'technieker_naam.required' => 'Naam technieker is verplicht.',
            'materiaal_id.required'    => 'Kies minstens één artikel.',
        ]);
// Registreert de retour van materialen door een technieker.    
        foreach ($request->materiaal_id as $index => $id) {
            if (!$id) continue;

            $aantal = $request->aantal[$index] ?? 1;

            Retour::create([
                'materiaal_id'    => $id,
                'aantal'          => $aantal,
                'technieker_naam' => $request->technieker_naam,
            ]);
    // Verhoogt automatisch de voorraad van het geretourneerde materiaal.   
            $materiaal = Materiaal::find($id);
            $materiaal->beschikbaar += $aantal;
            $materiaal->save();
        }
    // Wijzigt de status van de bestelling naar 'geretourneerd'.
        if ($request->bestelling_id) {
            $bestelling = Bestelling::find($request->bestelling_id);
            if ($bestelling) {
                $bestelling->status = 'geretourneerd';
                $bestelling->save();
            }
        }
    // Keert terug naar het retouroverzicht met een succesmelding.
        return redirect('/materiaal?sectie=retours')->with('succes', 'Retour geregistreerd!');
    }

    public function fotoUpload(Request $request, $id)
    {
        // Controleert of een geldige afbeelding werd geselecteerd.
        $request->validate([
            'foto' => 'required|image|max:2048',
        ], [
            'foto.required' => 'Kies een foto.',
            'foto.image'    => 'Het bestand moet een afbeelding zijn.',
            'foto.max'      => 'De foto mag maximaal 2MB zijn.',
        ]);
    // Uploadt de foto en koppelt deze aan het geselecteerde materiaal.
        $materiaal = Materiaal::find($id);
        $fotopad = $request->file('foto')->store('fotos', 'public');
        $materiaal->foto = $fotopad;
        $materiaal->save();

        return redirect('/materiaal')->with('succes', 'Foto opgeslagen!');
    }

    public function fotoVerwijderen($id)
    {
        // Verwijdert de gekoppelde foto van het geselecteerde materiaal.
        $materiaal = Materiaal::find($id);
        $materiaal->foto = null;
        $materiaal->save();

        return redirect('/materiaal')->with('succes', 'Foto verwijderd!');
    }

    public function searchLogic(Request $request)
    {
         // Haalt de ingevoerde zoekterm op en zet deze om naar kleine letters.
        $query = strtolower(trim($request->query('q', '')));
        
        // Geeft alle materialen terug indien de zoekterm te kort is.
        if (strlen($query) < 2) {
            return response()->json([
                'bedoelde_je' => null,
                'artikelen' => Materiaal::all()
            ]);
        }

        $materialen = Materiaal::all();
        // Thesaurus met synoniemen, vertalingen en veelvoorkomende typfouten.
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

         // Corrigeert automatisch foutieve zoektermen naar de officiële benaming.
        foreach ($thesaurus as $officieel => $fouten) {
            if (in_array($query, $fouten) || levenshtein($query, $officieel) <= 1) {
                $doelwit = $officieel;
                $queryIsCorrected = true;
                break;
            }
        }
    // Zoekt materialen op basis van omschrijving, artikelnummer
    // en ondersteunt fouttolerant zoeken via Levenshtein.
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
    // Stuurt de zoekresultaten en eventuele suggestie terug als JSON.
        return response()->json([
            'bedoelde_je' => $queryIsCorrected ? $doelwit : null,
            'artikelen' => $resultaten->values()
        ]);
    }

    public function magazijnSearchLogic(Request $request)
    {
         // Haalt de zoekterm op voor de magazijnzoekfunctie.
        $query = strtolower(trim($request->query('q', '')));
        // Geeft alle materialen terug indien geen zoekterm werd ingevoerd.
        if (strlen($query) < 1) {
            return response()->json(['artikelen' => Materiaal::all()]);
        }

        $materialen = Materiaal::all();
    // Zoekt materialen op basis van omschrijving, artikelnummer
    // en ondersteunt fouttolerant zoeken via Levenshtein.
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
// Stuurt de gevonden materialen terug als JSON-respons.
        return response()->json(['artikelen' => $resultaten->values()]);
    }

    public function bestellingOpzoeken(Request $request)
    {
        // Zoekt een bestelling op basis van het ingegeven bestelnummer.
        $nummer = $request->query('nummer');

        // Controleert of de bestelling bestaat en reeds werd klaargezet.
        $bestelling = Bestelling::with(['materiaal', 'user'])
            ->where('id', $nummer)
            ->where('status', 'klaargezet')
            ->first();

        if (!$bestelling) {
            return response()->json(['gevonden' => false]);
        }
        // Geeft de bestelgegevens terug aan de interface.
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
        // Haalt de inhoud van de winkelwagen op.
        $cart = json_decode($request->cart_data, true);
        // Controleert of de winkelwagen niet leeg is.
        if (!$cart || count($cart) === 0) {
            return redirect()->back()->with('error', 'Winkelwagen is leeg.');
        }

        $userId = Auth::id();
        if (!$userId) {
            $eersteUser = \App\Models\User::first();
            $userId = $eersteUser ? $eersteUser->id : 1;
        }
    // Controleert of voldoende voorraad beschikbaar is.
        foreach ($cart as $item) {
            $materiaal = Materiaal::find($item['id']);

            if (!$materiaal || $materiaal->beschikbaar < $item['aantal']) {
                return redirect()->back()->with('error', "Niet genoeg voorraad voor {$item['naam']}!");
            }
        // Maakt een nieuwe bestelling aan.
            Bestelling::create([
                'user_id'     => $userId,
                'onderdeel_id' => null,
                'materiaal_id' => $item['id'],
                'aantal'      => $item['aantal'],
                'status'      => 'in afwachting'
            ]);
        // Vermindert automatisch de voorraad van het bestelde materiaal.
            $materiaal->beschikbaar -= $item['aantal'];
            $materiaal->save();
        }
    // Bevestigt dat de bestelling succesvol werd geplaatst.
        return redirect()->back()->with('success', 'Bestelling succesvol geplaatst! Voorraad is bijgewerkt.');
    }

    public function magazijnierIndex()
    {
        // Haalt alle openstaande bestellingen op voor de magazijnier.
        $bestellingen = Bestelling::with(['materiaal', 'user'])
            ->where('status', 'in afwachting')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('materiaal.index', compact('bestellingen'));
    }

    public function klaarzetten($id)
    {
        // Wijzigt de status van een bestelling naar 'klaargezet'.
        $bestelling = Bestelling::findOrFail($id);
        $bestelling->status = 'klaargezet';
        $bestelling->save();

        return redirect()->back()->with('success', 'Bestelling succesvol klaargezet!');
    }

    public function bestellingTerugzetten($id)
    {
        // Zet een klaargezette bestelling terug naar 'in afwachting'.
        $bestelling = Bestelling::findOrFail($id);
        $bestelling->status = 'in afwachting';
        $bestelling->save();

        return redirect('/materiaal?sectie=meldingen')->with('succes', 'Bestelling teruggezet naar bestellingen!');
    }

    public function techniekerHistoriek()
    {
        // Haalt alle bestellingen van de ingelogde technieker op.
        $gebruiker_id = session('gebruiker_id', 1);

        $bestellingen = Bestelling::with('materiaal')
            ->where('user_id', $gebruiker_id)
            ->orderBy('created_at', 'desc')
            ->get();
        // Toont de bestelhistoriek van de technieker.
        return view('technieker.historiek', compact('bestellingen'));
    }
}