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

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::patch('/admin/users/{user}/role', [AdminController::class, 'updateRole']);
Route::post('/admin/users', [AdminController::class, 'store']);
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy']);
Route::patch('/admin/users/{user}/toggle', [AdminController::class, 'toggleStatus']);
Route::get('/admin/reports', [AdminController::class, 'reports']);
Route::get('/admin/storingen', [AdminController::class, 'storingen']);
Route::get('/admin/helpdesk', [AdminController::class, 'helpdesk']);
Route::get('/admin/helpdesk/gesloten', [AdminController::class, 'geslotenTickets']);
Route::get('/admin/helpdesk/{id}', [AdminController::class, 'showHelpdesk']);
Route::patch('/admin/helpdesk/{id}/sluiten', [AdminController::class, 'sluitGesprek']);
Route::post('/admin/helpdesk/{id}/bericht', [AdminController::class, 'verstuurBericht']);
Route::get('/admin/logout', [AuthController::class, 'logout']);

Route::get('/technieker', function () {
    return redirect()->route('materiaal.bestellen');
});

Route::controller(InstallatieController::class)->group(function () {
    Route::get('/technieker/meldingen', 'meldingen')->name('technieker.meldingen');
    Route::get('/installatie/{id}', 'show')->name('installatie.show');
    Route::post('/installatie/{id}/notitie', 'storeNotitie')->name('notitie.store');
    Route::get('/materiaal/bestellen', 'showBestelformulier')->name('materiaal.bestellen');
    Route::post('/installatie/{id}/valideren', 'valideren')->name('installatie.valideren');
    Route::post('/support/noodoproep', 'storeNoodoproep')->name('support.noodoproep');
});

Route::get('/api/materiaal/search', [MateriaalController::class, 'searchLogic'])->name('materiaal.search');
Route::get('/api/magazijn/search', [MateriaalController::class, 'magazijnSearchLogic']);
Route::get('/api/bestelling/opzoeken', [MateriaalController::class, 'bestellingOpzoeken']);

Route::post('/materiaal/bestellen', [MateriaalController::class, 'bestellingOpslaan'])->name('materiaal.bestellen.store');
Route::get('/technieker/historiek', [MateriaalController::class, 'techniekerHistoriek'])->name('technieker.historiek');
Route::get('/magazijnier/bestellingen', [MateriaalController::class, 'magazijnierIndex'])->name('magazijnier.bestellingen');
Route::patch('/magazijnier/bestellingen/{id}/klaarzetten', [MateriaalController::class, 'klaarzetten'])->name('magazijnier.klaarzetten');
Route::post('/bestellingen/{id}/terugzetten', [MateriaalController::class, 'bestellingTerugzetten']);

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
Route::post('/meldingen/{id}/archiveren', [MeldingController::class, 'archiveren']);
Route::post('/meldingen/{id}/terugzetten', [MeldingController::class, 'terugzetten']);

Route::post('/chat/start', [ChatController::class, 'start'])->name('chat.start');
Route::post('/chat/reply/{id}', [ChatController::class, 'reply'])->name('chat.reply');
Route::post('/chat/admin/reply/{id}', [ChatController::class, 'replyAdmin'])->name('chat.reply.admin');
Route::patch('/chat/sluiten/{id}', [ChatController::class, 'closeChat'])->name('chat.close');