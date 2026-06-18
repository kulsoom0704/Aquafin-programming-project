<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noodoproep;
use App\Models\ChatBericht;
use App\Models\User;

class ChatController extends Controller
{
    public function start(Request $request)
    {
        $request->validate([
            'doelgroep' => 'required',
            'bericht' => 'required'
        ]);

        $userId = session('gebruiker_id', 1);
        
      
        if (!User::where('id', $userId)->exists()) {
            $userId = 1;
        }

        $ticket = Noodoproep::create([
            'user_id' => $userId,
            'type' => $request->doelgroep,
            'bericht' => $request->bericht, 
            'status' => 'open'
        ]);

        ChatBericht::create([
            'noodoproep_id' => $ticket->id,
            'afzender_rol' => 'Technieker',
            'bericht' => $request->bericht,
            'gelezen' => false 
        ]);

        return redirect()->back()->with('chat_open', true);
    }

    
    public function reply(Request $request, string $id)
    {
        $request->validate(['reply' => 'required']);

        ChatBericht::create([
            'noodoproep_id' => $id,
            'afzender_rol' => 'Technieker',
            'bericht' => $request->reply,
            'gelezen' => false 
        ]);

        return redirect()->back()->with('chat_open', true);
    }

    
    public function replyAdmin(Request $request, string $id)
    {
        $request->validate(['reply' => 'required']);

        $ticket = Noodoproep::findOrFail($id);
        
        if($ticket->status !== 'gesloten') {
            ChatBericht::create([
                'noodoproep_id' => $id,
                'afzender_rol' => session('rol', 'Beheerder'),
                'bericht' => $request->reply,
                'gelezen' => false 
            ]);
        }

        return redirect()->back();
    }

   
    public function closeChat(string $id)
    {
        $ticket = Noodoproep::findOrFail($id);
        $ticket->status = 'gesloten';
        $ticket->save();

        return redirect()->back()->with('success', 'De conversatie is succesvol afgesloten.');
    }
}