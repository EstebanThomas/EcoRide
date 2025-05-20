<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preferences;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PreferencesController extends Controller
{
    public function ajouterPreferences(Request $request)
    {
        //Force bool for checkbox
        $request->merge([
            'fumeur' => $request->has('fumeur'),
            'animaux' => $request->has('animaux'),
        ]);

        $validated = $request->validate([
            'fumeur' => 'boolean|nullable',
            'animaux' => 'boolean|nullable',
            'propres_preferences' => 'string|max:100|nullable',
        ]);

        //Ignore empty datas
        foreach ($validated as $key => $value) {
            if ($value === null || $value === '') {
                unset($validated[$key]);
            }
        }
        
        try {
            Preferences::updateOrCreate(
                ['utilisateur_id' => Auth::id()],
                [
                    'fumeur' => $validated['fumeur'] ?? false,
                    'animaux' => $validated['animaux'] ?? false,
                    'propres_preferences' => $validated['propres_preferences'] ?? false,
                ]
            );
            return redirect()->route('espaceUtilisateur')->with('successPreferences', 'Préférences ajoutées !');
        } catch (\Exception) {
            return redirect()->back()->withInput()->withErrors(['general' => 'Une erreur est survenue lors de l\'ajout. Veuillez réessayer.']);
        }
    }
}
