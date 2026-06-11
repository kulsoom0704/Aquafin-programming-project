<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriaalController;
use App\Http\Controllers\MeldingController;
use App\Http\Controllers\WijzigingsverzoekController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstallatieController;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Registratie routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    // Validatie
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:gebruikers,email',
        'password' => 'required|min:4|confirmed',
    ]);
    
    try {
        $db = new PDO("sqlite:" . base_path('public/aquafin.db'));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $hashedPassword = password_hash($request->password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO Gebruikers (Naam, Email, Wachtwoord, Rol) VALUES (?, ?, ?, ?)");
        $stmt->execute([$request->name, $request->email, $hashedPassword, 'Technieker']);
        
        return redirect()->route('login')->with('success', 'Account succesvol aangemaakt! Je kunt nu inloggen.');
    } catch (Exception $e) {
        return back()->withErrors(['error' => 'Fout bij aanmaken account: ' . $e->getMessage()]);
    }
})->name('register.post');

Route::get('/technieker', function () {
    return redirect()->route('technieker.meldingen');
});

Route::controller(InstallatieController::class)->group(function () {
    Route::get('/technieker/meldingen', 'meldingen')->name('technieker.meldingen');
    Route::get('/installatie/{id}', 'show')->name('installatie.show');
    Route::post('/installatie/{id}/notitie', 'storeNotitie')->name('notitie.store');
    Route::get('/materiaal/bestellen', 'showBestelformulier')->name('materiaal.bestellen');
    Route::post('/materiaal/bestellen', 'storeBestelling')->name('materiaal.store');
    Route::get('/technieker/historiek', 'historiek')->name('technieker.historiek');
    Route::post('/installatie/{id}/valideren', 'valideren')->name('installatie.valideren');
    Route::post('/support/noodoproep', [App\Http\Controllers\InstallatieController::class, 'storeNoodoproep'])->name('support.noodoproep');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::get('/admin/reports', [AdminController::class, 'reports']);

Route::get('/materiaal', [MateriaalController::class, 'index']);
Route::get('/materiaal/create', [MateriaalController::class, 'create']);
Route::post('/materiaal', [MateriaalController::class, 'store']);
Route::get('/materiaal/{id}/wijzigen', [WijzigingsverzoekController::class, 'create']);
Route::post('/materiaal/{id}/wijzigen', [WijzigingsverzoekController::class, 'store']);
Route::post('/materiaal/{id}/foto', [MateriaalController::class, 'fotoUpload']);
Route::post('/materiaal/{id}/foto-verwijderen', [MateriaalController::class, 'fotoVerwijderen']);

Route::get('/levering', [MateriaalController::class, 'leveringCreate']);
Route::post('/levering', [MateriaalController::class, 'leveringStore']);

Route::get('/retour', [MateriaalController::class, 'retourCreate']);
Route::post('/retour', [MateriaalController::class, 'retourStore']);

Route::get('/meldingen', [MeldingController::class, 'index']);
Route::post('/meldingen/{id}/gelezen', [MeldingController::class, 'gelezen']);
Route::post('/meldingen/{id}/ongelezen', [MeldingController::class, 'ongelezen']);
Route::post('/meldingen/{id}/verwijderen', [MeldingController::class, 'verwijderen']);

Route::post('/register', function (Request $request) {
    // Validatie
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required|min:4|confirmed',
    ]);
    
    try {
        // Gebruik jullie eigen aquafin.db bestand
        $db = new PDO("sqlite:" . base_path('public/aquafin.db'));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Check of email al bestaat
        $check = $db->prepare("SELECT * FROM Gebruikers WHERE Email = ?");
        $check->execute([$request->email]);
        
        if ($check->fetch()) {
            return back()->withErrors(['email' => 'Dit emailadres bestaat al!']);
        }
        
        $hashedPassword = password_hash($request->password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO Gebruikers (Naam, Email, Wachtwoord, Rol) VALUES (?, ?, ?, ?)");
        $stmt->execute([$request->name, $request->email, $hashedPassword, 'Technieker']);
        
        return redirect()->route('login')->with('success', 'Account succesvol aangemaakt! Je kunt nu inloggen.');
    } catch (Exception $e) {
        return back()->withErrors(['error' => 'Fout bij aanmaken account: ' . $e->getMessage()]);
    }
})->name('register.post');