<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/covoiturages', function () {
    return view('covoiturages');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/home', [UtilisateurController::class, 'showHome'])->name('home');

Route::get('/connexion', [UtilisateurController::class, 'showConnexion']);

Route::get('/creation-compte', [UtilisateurController::class, 'showCreationAccount']);

Route::get('/espace-utilisateur', [UtilisateurController::class, 'showProfile'])->name('espaceUtilisateur');

Route::post('/connexion', [UtilisateurController::class, 'Connexion'])->name('utilisateur.connexion');

Route::post('/creation-utilisateur', [UtilisateurController::class, 'createAccount'])->name('utilisateur.creation');

Route::post('/deconnexion', [UtilisateurController::class, 'Deconnexion'])->name('utilisateur.deconnexion');

Route::post('/modifierInformations', [UtilisateurController::class, 'modifierInformations'])->name('utilisateur.modifier');
