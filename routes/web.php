<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriaalController;
use App\Http\Controllers\MeldingController;
use App\Http\Controllers\WijzigingsverzoekController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstallatieController;
use App\Http\Controllers\ChatController;


Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::post('/admin/users', [AdminController::class, 'store']);
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy']);
Route::patch('/admin/users/{user}/toggle', [AdminController::class, 'toggleStatus']);
Route::get('/admin/reports', [AdminController::class, 'reports']);
Route::get('/admin/storingen', [AdminController::class, 'storingen']);
Route::get('/admin/helpdesk', [AdminController::class, 'helpdesk']);
Route::get('/admin/helpdesk/{id}', [AdminController::class, 'showHelpdesk']);
Route::patch('/admin/helpdesk/{id}/sluiten', [AdminController::class, 'sluitGesprek']);
Route::post('/admin/helpdesk/{id}/bericht', [AdminController::class, 'verstuurBericht']);
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
    
    // Visueel bestelformulier (Webshop)
    Route::get('/materiaal/bestellen', 'showBestelformulier')->name('materiaal.bestellen');
    
    // Validatie- en supportroutes
    Route::post('/installatie/{id}/valideren', 'valideren')->name('installatie.valideren');
    Route::post('/support/noodoproep', 'storeNoodoproep')->name('support.noodoproep');
});


// API voor slimme zoekbalk
Route::get('/api/materiaal/search', [MateriaalController::class, 'searchLogic'])->name('materiaal.search');

// Technieker bevestigt zijn winkelwagen (bestelling versturen)
Route::post('/materiaal/bestellen', [MateriaalController::class, 'bestellingOpslaan'])->name('materiaal.bestellen.store');

// Technieker overzicht (status volgen)
Route::get('/technieker/historiek', [MateriaalController::class, 'techniekerHistoriek'])->name('technieker.historiek');

// Magazijnier dashboard
Route::get('/magazijnier/bestellingen', [MateriaalController::class, 'magazijnierIndex'])->name('magazijnier.bestellingen');
Route::patch('/magazijnier/bestellingen/{id}/klaarzetten', [MateriaalController::class, 'klaarzetten'])->name('magazijnier.klaarzetten');



Route::post('/chat/start', [ChatController::class, 'start'])->name('chat.start');
Route::post('/chat/reply/{id}', [ChatController::class, 'reply'])->name('chat.reply');
