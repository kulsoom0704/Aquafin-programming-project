<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriaalController;
use App\Http\Controllers\MeldingController;
use App\Http\Controllers\WijzigingsverzoekController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstallatieController;
use App\Http\Controllers\WeerController;

/*
|--------------------------------------------------------------------------
| Portal & Auth Routes (Nouveau et sécurisé)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('portal');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::post('/admin/users', [AdminController::class, 'store']);
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy']);
Route::patch('/admin/users/{user}/toggle', [AdminController::class, 'toggleStatus']);
Route::get('/admin/reports', [AdminController::class, 'reports']);
Route::get('/admin/storingen', [AdminController::class, 'storingen']);


/*
|--------------------------------------------------------------------------
| Installaties, Logboek & Meldingen (Technieker)
|--------------------------------------------------------------------------
*/
Route::get('/technieker', function () {
    return redirect()->route('materiaal.bestellen');
});

Route::controller(InstallatieController::class)->group(function () {
    Route::get('/technieker/meldingen', 'meldingen')->name('technieker.meldingen');
    Route::get('/installatie/{id}', 'show')->name('installatie.show');
    Route::post('/installatie/{id}/notitie', 'storeNotitie')->name('notitie.store');
    
    // Le formulaire visuel pour commander (Webshop)
    Route::get('/materiaal/bestellen', 'showBestelformulier')->name('materiaal.bestellen');
    
    // Routes de validation et de support
    Route::post('/installatie/{id}/valideren', 'valideren')->name('installatie.valideren');
    Route::post('/support/noodoproep', 'storeNoodoproep')->name('support.noodoproep');
});

Route::get('/technieker/weer', [WeerController::class, 'dashboard'])->name('technieker.weer');


/*
|--------------------------------------------------------------------------
| Webshop & Magazijnier (MateriaalController)
|--------------------------------------------------------------------------
*/
// L'API pour la barre de recherche intelligente
Route::get('/api/materiaal/search', [MateriaalController::class, 'searchLogic'])->name('materiaal.search');

// Le Technicien valide son panier (Envoi de la commande)
Route::post('/materiaal/bestellen', [MateriaalController::class, 'bestellingOpslaan'])->name('materiaal.bestellen.store');

// Le radar du Technicien (Suivi des statuts)
Route::get('/technieker/historiek', [MateriaalController::class, 'techniekerHistoriek'])->name('technieker.historiek');

// Le tableau de bord du Magasinier
Route::get('/magazijnier/bestellingen', [MateriaalController::class, 'magazijnierIndex'])->name('magazijnier.bestellingen');
Route::patch('/magazijnier/bestellingen/{id}/klaarzetten', [MateriaalController::class, 'klaarzetten'])->name('magazijnier.klaarzetten');
