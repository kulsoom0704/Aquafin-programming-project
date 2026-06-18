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
        // Validation basique de Laravel
        $request->validate([
            'email' => 'required|email',
            'wachtwoord' => 'required'
        ]);

        $email = $request->email;
        $wachtwoord = $request->wachtwoord;

        // On garde ton mot de passe unique pour faciliter les tests
        if ($wachtwoord === 'admin123') {
            
            // 1. RECHERCHE DYNAMIQUE DANS LA BASE DE DONNÉES
            $user = User::where('email', $email)->first();

            if ($user) {
                // Utilisateur trouvé : on sauvegarde ses infos en session
                Session::put([
                    'gebruiker_id' => $user->id,
                    'naam'         => $user->name,
                    'rol'          => $user->role,
                    'depot'        => $user->depot ?? 'Antwerpen' // 'Antwerpen' par défaut si la colonne est vide
                ]);

                // Redirection dynamique selon le rôle
                if ($user->role === 'Admin') {
                    return redirect('/admin/dashboard');
                } elseif ($user->role === 'Magazijnier') {
                    return redirect('/materiaal');
                } else {
                    return redirect()->route('materiaal.bestellen'); // Technieker
                }
            } 
            
            // 2. BACKUP DE SÉCURITÉ 
            // Si la base de données n'a pas encore l'Admin ou le Magasinier, on garde ce parachute
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