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
