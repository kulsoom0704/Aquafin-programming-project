<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallatieController;
use App\Http\Controllers\WeerController;

/*
|--------------------------------------------------------------------------
| Standaard Route (Algemeen)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('technieker.meldingen');
});


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

    Route::get('/technieker/weer', [WeerController::class, 'dashboard'])->name('technieker.weer');

});