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
        $users = User::orderBy('name')->get();

        return view('admin.users', compact('users'));
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('Welkom123!'),
            'role' => $request->role,
            'active' => true
        ]);

        return redirect('/admin/users');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/admin/users');
    }

    public function toggleStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return redirect('/admin/users');
    }

    public function storingen()
    {
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

        return view('admin.storingen', compact('storingen'));
    }

    public function helpdesk()
    {
      $oproepen = Noodoproep::with('technieker')
    ->where('status', 'open')
    ->latest()
    ->get();

    return view('admin.helpdesk', compact('oproepen'));
    }

   public function showHelpdesk($id)
{
    $oproep = Noodoproep::with([
        'technieker',
        'berichten'
    ])->findOrFail($id);

    return view('admin.gesprek', compact('oproep'));
}
public function sluitGesprek($id)
{
    $oproep = Noodoproep::findOrFail($id);

    $oproep->status = 'gesloten';
    $oproep->save();

    return redirect('/admin/helpdesk');
}
public function verstuurBericht(Request $request, $id)
{
    $request->validate([
        'bericht' => 'required'
    ]);

    ChatBericht::create([
        'noodoproep_id' => $id,
        'afzender_rol' => 'Admin',
        'bericht' => $request->bericht,
        'gelezen' => false
    ]);

    return redirect()->back();
}
public function geslotenTickets()
{
    $oproepen = Noodoproep::with('technieker')
        ->where('status', 'gesloten')
        ->latest()
        ->get();

    return view('admin.gesloten-tickets', compact('oproepen'));
}

}
