<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noodoproep;
use App\Models\ChatBericht;

// ChatController beheert de communicatie tussen techniekers en de helpdesk.
// Via deze controller kunnen nieuwe noodoproepen worden aangemaakt en kunnen
// techniekers reageren op bestaande gesprekken.

class ChatController extends Controller
{
    // Wanneer de technieker een nieuw gesprek start
   public function start(Request $request)
    {
    // Controleert of een doelgroep en bericht werden ingevuld.
        $request->validate([
            'doelgroep' => 'required',
            'bericht' => 'required'
        ]);
// Haalt de ingelogde gebruiker op uit de sessie.
        $userId = session('gebruiker_id', 1);

// Controleert of de gebruiker bestaat in de databank. 
// Indien niet, wordt gebruiker met ID 1 gebruikt als fallback.
        if (!\App\Models\User::where('id', $userId)->exists()) {
            $userId = 1;
        }

    // Maakt een nieuwe noodoproep aan in de databank.
        $ticket = \App\Models\Noodoproep::create([
            'user_id' => $userId,
            'type' => $request->doelgroep,
            'bericht' => $request->bericht, 
            'status' => 'open'
        ]);

    // Slaat het eerste bericht van de technieker op als chatbericht.
        \App\Models\ChatBericht::create([
            'noodoproep_id' => $ticket->id,
            'afzender_rol' => 'Technieker',
            'bericht' => $request->bericht,
            'gelezen' => true
        ]);

    // Toont een succesmelding nadat het bericht werd verzonden.
        return redirect()->back()->with('success', 'Je bericht is succesvol verzonden naar de ' . $request->doelgroep . '!');
    }
    // Wanneer de technieker in een bestaand gesprek reageert
    public function reply(Request $request, $id)
    {
        // Controleert of een antwoord werd ingevuld.
        $request->validate(['reply' => 'required']);

    // Slaat het nieuwe antwoord van de technieker op in de databank.
        ChatBericht::create([
            'noodoproep_id' => $id,
            'afzender_rol' => 'Technieker',
            'bericht' => $request->reply,
            'gelezen' => true
        ]);
// Vernieuwt de pagina zodat het nieuwe bericht zichtbaar wordt.
        return redirect()->back();
    }
}