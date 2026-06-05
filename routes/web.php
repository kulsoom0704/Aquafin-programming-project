<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaalController;
use App\Http\Controllers\MeldingController;
use App\Http\Controllers\WijzigingsverzoekController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstallatieController;

/*
|--------------------------------------------------------------------------
|login, register, admin_panel, magazijnier_panel, portaal Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () { require public_path('start.php'); exit; });
Route::any('/start.php', function () { require public_path('start.php'); exit; });
Route::any('/login.php', function () { require public_path('login.php'); exit; });
Route::any('/register.php', function () { require public_path('register.php'); exit; });
Route::any('/leeg.php', function () { require public_path('leeg.php'); exit; });
Route::any('/logout.php', function () { require public_path('logout.php'); exit; });
Route::any('/admin_panel.php', function () { require public_path('admin_panel.php'); exit; });
Route::any('/magazijnier_panel.php', function () { require public_path('magazijnier_panel.php'); exit; });
Route::any('/portaal.php', function () { require public_path('portaal.php'); exit; });


/*
|--------------------------------------------------------------------------
|  Technieker 
|--------------------------------------------------------------------------
*/


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
});


/*
|--------------------------------------------------------------------------
| Admin Routes (Laravel)
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::get('/admin/reports', [AdminController::class, 'reports']);


/*
|--------------------------------------------------------------------------
| Materiaal, Levering & Retour (Magazijnier & Meldingen en Laravel)
|--------------------------------------------------------------------------
*/

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