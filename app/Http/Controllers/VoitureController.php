<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voiture;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Marque;

class VoitureController extends Controller
{
    //Add car
    public function ajouterVehicule(Request $request){

        $validated = $request->validate([
            'modele' => 'required|max:20',
            'immatriculation' => 'required|unique:Voiture,immatriculation|max:9|regex:/^[A-Za-z]{2}-\d{3}-[A-Za-z]{2}$/',
            'datePremiereImmatriculation' => 'required|date|before_or_equal:today|after_or_equal:1950-01-01',
            'couleur' => 'required|max:20|regex:/^[A-Za-z0-9\s\-]+$/',
            'energie' => 'nullable',
            'marque' => 'required|exists:Marque,marque_id',
        ]);

        $energie = $request->has('energie') ? 'Oui' : 'Non';

        $validated['immatriculation'] = strtoupper($validated['immatriculation']);

        try {
            Voiture::create([
                'modele'=> $validated['modele'],
                'immatriculation' => $validated['immatriculation'],
                'date_premiere_immatriculation'=> $validated['datePremiereImmatriculation'],
                'couleur' => $validated['couleur'],
                'energie'=> $energie,
                'utilisateur_id' => Auth::id(),
                'marque_id' => $validated['marque'],
            ]);
            return redirect()->route('espaceUtilisateur')->with('successAdd', 'Véhicule ajouté !');
        }
        catch (\Exception $e){
            Log::error('Erreur lors de l\'ajout du véhicule : '.$e->getMessage());
            return redirect()->back()->withInput()->withErrors(['general' => 'Une erreur est survenue lors de l\'ajout. Veuillez réessayer.' . $e->getMessage()]);
        }
    }


    //Get user's cars
    public function afficherVehicules()
    {
        $vehicules = Voiture::with('Marque')
            ->where('utilisateur_id', Auth::id())
            ->get();
        return response()->json($vehicules);
    }


    //delete car
    public function deleteCar($voiture_id){
        $voiture = Voiture::where('voiture_id', $voiture_id)->firstOrFail(); //Search the first car with this id in the table or error 404

        if($voiture->utilisateur_id !== Auth::id()){
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $voiture->delete();
    }

}