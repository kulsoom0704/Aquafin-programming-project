<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaalController;
use App\Http\Controllers\MeldingController;
use App\Http\Controllers\WijzigingsverzoekController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstallatieController;

/*
|--------------------------------------------------------------------------
| Standaard Route (Algemeen)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('technieker.meldingen');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::get('/admin/reports', [AdminController::class, 'reports']);

/*
|--------------------------------------------------------------------------
| Installaties, Logboek & Bestellingen (InstallatieController)
|--------------------------------------------------------------------------
*/

Route::controller(InstallatieController::class)->group(function () {
    
    
    Route::get('/technieker/meldingen', 'meldingen')->name('technieker.meldingen');

    Route::get('/installatie/{id}', 'show')->name('installatie.show');

    Route::post('/installatie/{id}/notitie', 'storeNotitie')->name('notitie.store');

    Route::get('/materiaal/bestellen', 'showBestelformulier')->name('materiaal.bestellen');
    
    Route::post('/materiaal/bestellen', 'storeBestelling')->name('materiaal.store');

    Route::get('/technieker/historiek', [InstallatieController::class, 'historiek'])->name('technieker.historiek');

});

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
