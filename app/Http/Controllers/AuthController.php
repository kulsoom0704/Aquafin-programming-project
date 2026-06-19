<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Basisvalidatie van logingegevens
        $request->validate([
            'email' => 'required|email',
            'wachtwoord' => 'required'
        ]);

        $email = $request->email;
        $wachtwoord = $request->wachtwoord;

        // Gebruik één testwachtwoord voor snelle ontwikkelaarslogin
        if ($wachtwoord === 'admin123') {
            
            // Zoek dynamisch de gebruiker op basis van e-mailadres
            $user = User::where('email', $email)->first();

            if ($user) {
                // Gebruiker gevonden: gegevens in sessie zetten
                Session::put([
                    'gebruiker_id' => $user->id,
                    'naam'         => $user->name,
                    'rol'          => $user->role,
                    'depot'        => $user->depot ?: 'Antwerpen'
                ]);

                // Redirect op basis van gebruikersrol
                if ($user->role === 'Admin') {
                    return redirect('/admin/dashboard');
                } elseif ($user->role === 'Magazijnier') {
                    return redirect('/materiaal');
                } else {
                    return redirect()->route('materiaal.bestellen'); // Technieker
                }
            } 
            
            // Fallback voor testaccounts als de database nog leeg is
            else {
                if ($email === 'admin@aquafin.be') {
                    Session::put([
                        'gebruiker_id' => 999, 
                        'naam'         => 'Admin Test', 
                        'rol'          => 'Admin', 
                        'depot'        => 'Hoofdkantoor'
                    ]);
                    return redirect('/admin/dashboard');
                } elseif ($email === 'magazijnier@aquafin.be') {
                    Session::put([
                        'gebruiker_id' => 888, 
                        'naam'         => 'Marie Janssens', 
                        'rol'          => 'Magazijnier', 
                        'depot'        => 'Antwerpen'
                    ]);
                    return redirect('/materiaal'); 
                }
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