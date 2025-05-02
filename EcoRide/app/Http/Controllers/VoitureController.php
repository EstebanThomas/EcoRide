<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voiture;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VoitureController extends Controller
{
    //Add car
    public function ajouterVehicule(Request $request){

        $validated = $request->validate([
            'modele' => 'required|max:20',
            'immatriculation' => 'required|unique:voiture,immatriculation|max:9|regex:/^[A-Z]{2}-\d{3}-[A-Z]{2}$/',
            'datePremiereImmatriculation' => 'required|date|before_or_equal:today',
            'couleur' => 'required|max:20|regex:/^[A-Za-z0-9\s\-]+$/',
            'energie' => 'required|regex:/^[A-Za-z0-9\s\-]+$/'
        ]);

        Voiture::create([
            'modele'=> $validated['modele'],
            'immatriculation' => $validated['immatriculation'],
            'date_premiere_immatriculation'=> $validated['datePremiereImmatriculation'],
            'couleur' => $validated['couleur'],
            'energie'=> $validated['energie'],
            'utilisateur_id' => Auth::id(),
        ]);

        return redirect()->route('espaceUtilisateur');
    }
}
