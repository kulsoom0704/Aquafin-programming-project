<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validation basique de Laravel
        $request->validate([
            'email' => 'required|email',
            'wachtwoord' => 'required'
        ]);

        $email = $request->email;
        $wachtwoord = $request->wachtwoord;

        
        if ($wachtwoord === 'admin123') {
            if ($email === 'admin@aquafin.be') {
                Session::put(['gebruiker_id' => 999, 'naam' => 'Admin Test', 'rol' => 'Admin']);
                return redirect('/admin/dashboard');
            } elseif ($email === 'lukas@aquafin.be' || $email === 'technieker@aquafin.be') {
                Session::put(['gebruiker_id' => 1, 'naam' => 'Lukas Peeters', 'rol' => 'Technieker']);
                return redirect()->route('materiaal.bestellen'); // 🟢 Modifié ici
            } elseif ($email === 'emma@aquafin.be') {
                Session::put(['gebruiker_id' => 2, 'naam' => 'Emma Claes', 'rol' => 'Technieker']);
                return redirect()->route('materiaal.bestellen'); // 🟢 Modifié ici
            } elseif ($email === 'thomas@aquafin.be') {
                Session::put(['gebruiker_id' => 3, 'naam' => 'Thomas Maes', 'rol' => 'Technieker']);
                return redirect()->route('materiaal.bestellen'); // 🟢 Modifié ici
            } elseif ($email === 'magazijnier@aquafin.be') {
                Session::put(['gebruiker_id' => 888, 'naam' => 'Marie Janssens', 'rol' => 'Magazijnier']);
                return redirect('/materiaal'); 
            }
        }

        return back()->with('error', 'Foutief emailadres of wachtwoord.');
    }

    public function logout()
    {
        Session::flush(); 
        return redirect('/login');
    }
}