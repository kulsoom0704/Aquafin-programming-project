<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriaalController;
use App\Http\Controllers\MeldingController;
use App\Http\Controllers\WijzigingsverzoekController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstallatieController;

/*
| Portal & Auth Routes (Nouveau et sécurisé)

*/


Route::get('/', function () {
    return view('portal');
})->name('home');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/*

| Technieker Routes

*/

Route::get('/technieker', function () {
    return redirect()->route('materiaal.bestellen');
});

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


/*
|--------------------------------------------------------------------------
| Installaties, Logboek & Bestellingen
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Installaties, Logboek & Bestellingen
|--------------------------------------------------------------------------
*/

Route::controller(InstallatieController::class)->group(function () {

    Route::get('/technieker/meldingen', 'meldingen')
        ->name('technieker.meldingen');

    Route::get('/installatie/{id}', 'show')
        ->name('installatie.show');

    Route::post('/installatie/{id}/notitie', 'storeNotitie')
        ->name('notitie.store');

    Route::get('/materiaal/bestellen', 'showBestelformulier')
        ->name('materiaal.bestellen');

    Route::post('/materiaal/bestellen', 'storeBestelling')
        ->name('materiaal.store');

    Route::get('/technieker/historiek', 'historiek')
        ->name('technieker.historiek');

    // Les deux routes restaurées pour le bon fonctionnement !
    Route::post('/installatie/{id}/valideren', 'valideren')
        ->name('installatie.valideren');

    Route::post('/support/noodoproep', 'storeNoodoproep')
        ->name('support.noodoproep');
});