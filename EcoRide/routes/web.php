<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\CovoiturageController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/covoiturages', [CovoiturageController::class, 'showCovoiturage']);

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

Route::post('/ajouterVehicule', [VoitureController::class, 'ajouterVehicule'])->name('vehicule.ajouter');

Route::get('/api/vehicules', [VoitureController::class, 'afficherVehicules']);

Route::delete('/voiture/{voiture_id}', [VoitureController::class, 'deleteCar'])->name('vehicule.supprimer');

Route::post('/ajouterPreferences', [PreferencesController::class, 'ajouterPreferences'])->name('preferences.ajouter');

Route::post('/ajouterCovoiturage', [CovoiturageController::class, 'ajouterCovoiturage'])->name('covoiturage.ajouter');

Route::patch('/voyage/{voiture_id}', [CovoiturageController::class, 'annulerVoyage'])->name('voyage.annuler');

Route::get('/details/{id}', [CovoiturageController::class, 'showRideDetails'])->name('covoiturage.details');

Route::get('/rechercherCovoiturages', [CovoiturageController::class, 'rechercherCovoiturage'])->name('covoiturage.rechercher');