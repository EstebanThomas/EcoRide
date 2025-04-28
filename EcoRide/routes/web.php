<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/covoiturages', function () {
    return view('covoiturages');
});

Route::get('/connexion', function () {
    return view('connexion');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/creation-compte', function () {
    return view('creation-compte');
});

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Connexion à la base de données réussie !';
    } catch (\Exception $e) {
        return 'Impossible de se connecter à la base de données. Erreur : ' . $e->getMessage();
    }
});
