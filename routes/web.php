<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaalController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/materiaal', [MateriaalController::class, 'index']);
Route::get('/materiaal/create', [MateriaalController::class, 'create']);
Route::post('/materiaal', [MateriaalController::class, 'store']);
