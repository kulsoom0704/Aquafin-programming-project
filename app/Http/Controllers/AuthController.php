<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// AuthController beheert het inloggen en uitloggen van gebruikers.
class AuthController extends Controller
{
    public function showLoginForm()
    {
// Toont het loginformulier aan de gebruiker.
        return view('auth.login');
    }

    public function login(Request $request)
    {
 // Controleert of e-mailadres en wachtwoord correct werden ingevuld.
        $request->validate([
            'email' => 'required|email',
            'wachtwoord' => 'required'
        ]);
// Haalt de ingevoerde gegevens uit het loginformulier op.
        $email = $request->email;
        $wachtwoord = $request->wachtwoord;

// Controleert of het ingevoerde wachtwoord overeenkomt met het testwachtwoord
        if ($wachtwoord === 'admin123') {
    // Controleert of de gebruiker een administrator is.
            if ($email === 'admin@aquafin.be') {

    // Slaat de sessiegegevens van de administrator op.
                Session::put(['gebruiker_id' => 999, 'naam' => 'Admin Test', 'rol' => 'Admin']);
        
    // Stuurt de administrator door naar het dashboard.
                return redirect('/admin/dashboard');
    
    // Controleert of de gebruiker een technieker is.
            } elseif ($email === 'lukas@aquafin.be' || $email === 'technieker@aquafin.be') {

    // Maakt een sessie aan voor technieker Lukas.
                Session::put(['gebruiker_id' => 1, 'naam' => 'Lukas Peeters', 'rol' => 'Technieker']);
    // Stuurt de technieker door naar het bestelformulier.
                return redirect()->route('materiaal.bestellen'); // 🟢 Modifié ici 
    
    // Maakt een sessie aan voor technieker Emma.
            } elseif ($email === 'emma@aquafin.be') {
                Session::put(['gebruiker_id' => 2, 'naam' => 'Emma Claes', 'rol' => 'Technieker']);
    
                return redirect()->route('materiaal.bestellen'); // 🟢 Modifié ici 
    // Maakt een sessie aan voor technieker Thomas.
            } elseif ($email === 'thomas@aquafin.be') {
                Session::put(['gebruiker_id' => 3, 'naam' => 'Thomas Maes', 'rol' => 'Technieker']);
                return redirect()->route('materiaal.bestellen'); // 🟢 Modifié ici 
    // Maakt een sessie aan voor magazijnier.
            } elseif ($email === 'magazijnier@aquafin.be') {
                Session::put(['gebruiker_id' => 888, 'naam' => 'Marie Janssens', 'rol' => 'Magazijnier']);
    // Stuurt de magazijnier naar het materiaaloverzicht.
                return redirect('/materiaal'); 
            }
        }
// Geeft een foutmelding wanneer de logingegevens ongeldig zijn.
        return back()->with('error', 'Foutief emailadres of wachtwoord.');
    }

    public function logout()
    {
    // Verwijdert alle sessiegegevens van de huidige gebruiker.
        Session::flush(); 
    // Stuurt de gebruiker terug naar het loginformulier.
        return redirect('/login');
    }
}