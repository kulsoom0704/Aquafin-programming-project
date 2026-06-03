<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallatieController;


Route::get('/', function () {
    return redirect()->route('technieker.meldingen');
});


Route::get('/technieker/meldingen', [InstallatieController::class, 'meldingen'])->name('technieker.meldingen');
