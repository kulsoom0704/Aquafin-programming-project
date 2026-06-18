<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Noodoproep;
use Illuminate\Support\Facades\Hash;
use App\Models\ChatBericht;
use App\Models\Installatie;

// AdminController beheert alle functionaliteiten voor de administrator,
// waaronder dashboardstatistieken, gebruikersbeheer, storingen en helpdeskbeheer.

class AdminController extends Controller
{
    public function dashboard()
    {
// Simulatiegegevens van jaarlijkse neerslag en bijhorend overstromingsrisico.
// Wordt gebruikt voor de grafiek of statistieken op het dashboard.

        $rainfall = [
            ['year' => 2026, 'rainfall' => 950, 'risk' => 'Laag'],
            ['year' => 2027, 'rainfall' => 1010, 'risk' => 'Gemiddeld'],
            ['year' => 2028, 'rainfall' => 1120, 'risk' => 'Hoog'],
            ['year' => 2029, 'rainfall' => 1150, 'risk' => 'Hoog'],
            ['year' => 2030, 'rainfall' => 1050, 'risk' => 'Gemiddeld'],
        ];
// Telt het totale aantal geregistreerde gebruikers.
        $userCount = User::count();

// Telt alle openstaande noodoproepen die nog behandeld moeten worden.
        $helpdeskCount = Noodoproep::where('status', 'open')->count();

// Telt het aantal installaties dat in de databank geregistreerd staat.
        $installatieCount = Installatie::count();

// Telt het aantal reeds afgesloten helpdesktickets.
        $geslotenTickets = Noodoproep::where('status', 'gesloten')->count();

// Stuurt alle dashboardgegevens door naar de dashboardpagina.
        return view(
    'admin.dashboard',
    compact(
    'rainfall',
    'userCount',
    'helpdeskCount',
    'installatieCount',
    'geslotenTickets'
)
);
    }

    public function users()
    {
// Haalt alle gebruikers op en sorteert deze alfabetisch op naam.
        $users = User::orderBy('name')->get();

// Stuurt de gebruikerslijst door naar de gebruikerspagina.
        return view('admin.users', compact('users'));
    }
// Opent de rapportenpagina voor de administrator.
    public function reports()
    {
        return view('admin.reports');
    }

    public function store(Request $request)
    {
// Controleert of alle verplichte velden correct zijn ingevuld.
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required'
        ]);
// Maakt een nieuwe gebruiker aan met een standaard wachtwoord.
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('Welkom123!'),
            'role' => $request->role,
            'active' => true
        ]);

// Keert terug naar het gebruikersoverzicht.
        return redirect('/admin/users');
    }

    public function destroy(User $user)
    {
// Verwijdert een geselecteerde gebruiker uit de databank.
        $user->delete();

        return redirect('/admin/users');
    }

    public function toggleStatus(User $user)
    {
// Activeert of deactiveert een gebruiker.
        $user->active = !$user->active;
        $user->save();

        return redirect('/admin/users');
    }

    public function storingen()
    {

// Voorbeeldgegevens van storingen met locatie, type en prioriteit.
        $storingen = [
            [
                'locatie' => 'Brussel Noord',
                'type' => 'Overstroming',
                'status' => 'Kritiek'
            ],
            [
                'locatie' => 'Antwerpen Centrum',
                'type' => 'Waterlek',
                'status' => 'Gemiddeld'
            ],
            [
                'locatie' => 'Gent Zuid',
                'type' => 'Rioolprobleem',
                'status' => 'Laag'
            ]
        ];
// Stuurt de storingsgegevens naar de storingenpagina.
        return view('admin.storingen', compact('storingen'));
    }

    public function helpdesk()
    {
// Haalt alle openstaande noodoproepen op inclusief gekoppelde technieker.
      $oproepen = Noodoproep::with('technieker')
    ->where('status', 'open')
    ->latest()
    ->get();

// Toont het overzicht van openstaande helpdeskoproepen.
    return view('admin.helpdesk', compact('oproepen'));
    }

   public function showHelpdesk($id)
{
// Haalt één specifieke noodoproep op inclusief technieker en chatberichten.
    $oproep = Noodoproep::with([
        'technieker',
        'berichten'
    ])->findOrFail($id);

// Opent het detailgesprek van de geselecteerde oproep.
    return view('admin.gesprek', compact('oproep'));
}
public function sluitGesprek($id)
{
// Zoekt de geselecteerde noodoproep op.
    $oproep = Noodoproep::findOrFail($id);

// Wijzigt de status naar gesloten.
    $oproep->status = 'gesloten';
    $oproep->save();
// Keert terug naar het helpdeskoverzicht.
    return redirect('/admin/helpdesk');
}
public function verstuurBericht(Request $request, $id)
{
// Controleert of een bericht werd ingevoerd.
    $request->validate([
        'bericht' => 'required'
    ]);
// Slaat een nieuw chatbericht op in de databank.
    ChatBericht::create([
        'noodoproep_id' => $id,
        'afzender_rol' => 'Admin',
        'bericht' => $request->bericht,
        'gelezen' => false
    ]);
// Vernieuwt het gesprek zodat het nieuwe bericht zichtbaar wordt.
    return redirect()->back();
}
public function geslotenTickets()
{
// Haalt alle afgesloten noodoproepen op inclusief gekoppelde technieker.
    $oproepen = Noodoproep::with('technieker')
        ->where('status', 'gesloten')
        ->latest()
        ->get();
// Toont het overzicht van afgesloten helpdesktickets.
    return view('admin.gesloten-tickets', compact('oproepen'));
}

}
