<?php

use Illuminate\Support\Facades\Route;

// Startpagina met 3 kaarten
Route::get('/', function () {
    return view('start');
});

// Login pagina
Route::get('/login', function () {
    return view('login');
})->name('login');

// Login verwerken
Route::post('/login', function () {
    // Hier komt later de login logica
    return view('login');
});

// Registratie pagina
Route::get('/register', function () {
    return view('register');
});

// Admin panel
Route::get('/admin', function () {
    return view('admin_panel');
});

// Technieker panel
Route::get('/technieker', function () {
    return view('technieker_panel');
});

// Magazijnier panel
Route::get('/magazijnier', function () {
    return view('magazijnier_panel');
});

// Portaal
Route::get('/portaal', function () {
    return view('portaal');
});

// Uitloggen
Route::get('/logout', function () {
    return view('logout');
});