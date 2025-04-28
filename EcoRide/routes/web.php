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

Route::get('/creation-compte', function () {
    return view('creation-compte');
});

Route::middleware('auth')->get('/espace-utilisateur', function () {
    return view('espace-utilisateur');
});

Route::get('/connexion', function () {
    return view('connexion');
});


Route::post('/creation-utilisateur', [UtilisateurController::class, 'store'])->name('utilisateur.creation');

Route::post('/utilisateur', [UtilisateurController::class, 'store'])->name('utilisateur.connexion');