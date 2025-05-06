<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Covoiturage;
use Illuminate\Http\Request;
use App\Models\Preferences;
use App\Models\Voiture;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CovoiturageController extends Controller
{
    public function ajouterCovoiturage(Request $request)
    {
        $today = now()->startofDay();
        $maxDate = now()->addMonth(2)->endOfDay();

        $validated = $request->validate([
            'date_depart' => 'required|date|after:'.$today.'|before_or_equal:'.$maxDate,
            'heure_depart' => 'required|date_format:H:i',
            'lieu_depart' => 'required|max:50|regex:/^[A-Za-z0-9\s\-]+$/',
            'date_arrivee' => 'required|date|after_or_equal:date_depart',
            'heure_arrivee' => 'required|date_format:H:i',
            'lieu_arrivee' => 'required|max:50|regex:/^[A-Za-z0-9\s\-]+$/',
            'nb_place' => 'required|integer|min:1|max:7',
            'prix_personne' => 'required|numeric|min:0|max:100',
            'select_voiture' => 'required|exists:voiture,voiture_id',
        ]);

        try {
            Covoiturage::create([
                'date_depart' => $validated['date_depart'],
                'heure_depart' => $validated['heure_depart'],
                'lieu_depart' => $validated['lieu_depart'],
                'date_arrivee' => $validated['date_arrivee'],
                'heure_arrivee' => $validated['heure_arrivee'],
                'lieu_arrivee' => $validated['lieu_arrivee'],
                'nb_place' => $validated['nb_place'],
                'prix_personne' => $validated['prix_personne'],
                'voiture_id' => $validated['select_voiture'],
                'statut' => 'disponible',
                'utilisateur_id' => Auth::id(),
                'preferences_id' => Preferences::where('utilisateur_id', Auth::id())->value('preferences_id'),
            ]);
            return redirect()->route('espaceUtilisateur')->with('successAddRide', 'Voyage ajouté !');
        }
        catch (\Exception $e){
            Log::error('Erreur lors de l\'ajout du voyage : '.$e->getMessage());
            return redirect()->back()->withInput()->withErrors(['general' => 'Une erreur est survenue lors de l\'ajout. Veuillez réessayer.' .$e->getMessage()]);
        }

        return redirect()->route('espaceUtilisateur');
    }
}
