<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallatieController;

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
| Installaties & Logboek (InstallatieController)
|--------------------------------------------------------------------------
*/

Route::controller(InstallatieController::class)->group(function () {
    
    // 1. Dashboard: Overzicht van alle onderhoudsmeldingen
    Route::get('/technieker/meldingen', 'meldingen')->name('technieker.meldingen');

    // 2. Detailpagina: Specifieke installatie en logboek bekijken
    Route::get('/installatie/{id}', 'show')->name('installatie.show');

    // 3. Actie: Nieuwe notitie opslaan in het logboek
    Route::post('/installatie/{id}/notitie', 'storeNotitie')->name('notitie.store');

});