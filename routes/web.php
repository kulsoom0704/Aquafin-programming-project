<?php

use Illuminate\Support\Facades\Route;
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
