<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noodoproep;
use App\Models\ChatBericht;

class ChatController extends Controller
{
    // Wanneer de technieker een nieuw gesprek start
   public function start(Request $request)
    {
        $request->validate([
            'doelgroep' => 'required',
            'bericht' => 'required'
        ]);

        $userId = session('gebruiker_id', 1);
        if (!\App\Models\User::where('id', $userId)->exists()) {
            $userId = 1;
        }

        
        $ticket = \App\Models\Noodoproep::create([
            'user_id' => $userId,
            'type' => $request->doelgroep,
            'bericht' => $request->bericht, 
            'status' => 'open'
        ]);

        
        \App\Models\ChatBericht::create([
            'noodoproep_id' => $ticket->id,
            'afzender_rol' => 'Technieker',
            'bericht' => $request->bericht,
            'gelezen' => true
        ]);

        // Le fameux message flash dynamique !
        return redirect()->back()->with('success', 'Je bericht is succesvol verzonden naar de ' . $request->doelgroep . '!');
    }
    // Wanneer de technieker in een bestaand gesprek reageert
    public function reply(Request $request, $id)
    {
        $request->validate(['reply' => 'required']);

        ChatBericht::create([
            'noodoproep_id' => $id,
            'afzender_rol' => 'Technieker',
            'bericht' => $request->reply,
            'gelezen' => true
        ]);

        return redirect()->back();
    }
}