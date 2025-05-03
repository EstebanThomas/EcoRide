<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voiture;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VoitureController extends Controller
{
    //Add car
    public function ajouterVehicule(Request $request){

        $validated = $request->validate([
            'modele' => 'required|max:20',
            'immatriculation' => 'required|unique:voiture,immatriculation|max:9|regex:/^[A-Za-z]{2}-\d{3}-[A-Za-z]{2}$/',
            'datePremiereImmatriculation' => 'required|date|before_or_equal:today',
            'couleur' => 'required|max:20|regex:/^[A-Za-z0-9\s\-]+$/',
            'energie' => 'nullable',
        ]);

        $energie = $request->has('energie') ? 'Oui' : 'Non';

        try {
            Voiture::create([
                'modele'=> $validated['modele'],
                'immatriculation' => $validated['immatriculation'],
                'date_premiere_immatriculation'=> $validated['datePremiereImmatriculation'],
                'couleur' => $validated['couleur'],
                'energie'=> $energie,
                'utilisateur_id' => Auth::id(),
            ]);
        return redirect()->route('espaceUtilisateur')->with('success', 'Véhicule ajouté !');
        }
        catch (\Exception $e){
            Log::error('Erreur lors de l\'ajout du véhicule : '.$e->getMessage());
            return redirect()->back()->withInput()->withErrors(['general' => 'Une erreur est survenue lors de l\'ajout. Veuillez réessayer.']);
        }
    }


    //Get user's cars
    public function afficherVehicules()
    {
        $vehicules = Voiture::where('utilisateur_id', Auth::id())->get();
        return response()->json($vehicules);
    }

}
