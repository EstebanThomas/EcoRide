<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\CovoiturageController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/covoiturages', [CovoiturageController::class, 'showCovoiturage']);

Route::get('/mentionsLegales', function () {
    return view('mentions-legales');
});

Route::get('/politiqueConfidentialite', function () {
    return view('politique-confidentialite');
});

Route::get('/politiqueCookies', function () {
    return view('politique-cookies');
})->name('politique.cookies');

Route::get('/gererCookies', function () {
    return view('gerer-cookies');
})->name('gerer.cookies');

Route::post('/cookies/prefs', [CookieController::class, 'store'])->name('cookies.store');

Route::get('/home', [UtilisateurController::class, 'showHome'])->name('home');

Route::get('/connexion', [UtilisateurController::class, 'showConnexion'])->name('page.connexion');

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

Route::post('/covoiturage/{id}/participer', [CovoiturageController::class, 'participerCovoiturage'])->name('covoiturage.participer');

Route::post('/covoiturage/{id}/quitter', [CovoiturageController::class, 'quitterCovoiturage'])->name('covoiturage.quitter');

Route::post('/voyage/{id}/demarrer', [CovoiturageController::class, 'demarrerCovoiturage'])->name('covoiturage.demarrer');

Route::post('/voyage/{id}/arreter', [CovoiturageController::class, 'arreterCovoiturage'])->name('covoiturage.arreter');

Route::get('/contact', [ContactController::class, 'showContact'])->name('contact.form');

Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');

Route::post('/espace-administrateur', [UtilisateurController::class, 'showAdmin'])->name('espaceAdministrateur');

Route::post('/espace-employe', [UtilisateurController::class, 'showEmploye'])->name('espaceEmploye');

Route::post('/creation-employe', [UtilisateurController::class, 'createAccountEmploye'])->name('employe.creation');