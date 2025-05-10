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
use Illuminate\Support\Carbon;

class CovoiturageController extends Controller
{

    public function showCovoiturage()
    {
        $covoiturages = Covoiturage::where('statut', 'disponible')->get();
        return view('covoiturages', ['covoiturages' => $covoiturages]);
    }

    public function showRideDetails($id){

        try{
            $covoiturage = Covoiturage::with('utilisateur', 'voiture', 'voiture.marque', 'utilisateur.preferences')
            ->where('statut', 'disponible')
            ->where('covoiturage_id', $id)
            ->firstOrFail();

            return view('details', ['covoiturage' => $covoiturage]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Une erreur est survenue lors de la récupération des détails. Veuillez réessayer.']);
        }
        
    }

    //Add a ride
    public function ajouterCovoiturage(Request $request)
    {
        $today = now()->startOfDay();
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

    //Search for a ride and filters
    public function rechercherCovoiturage(Request $request)
    {
        $validated = $request->validate([
            'lieu_depart' => 'required|max:50|regex:/^[A-Za-z0-9\s\-]+$/',
            'lieu_arrivee' => 'required|max:50|regex:/^[A-Za-z0-9\s\-]+$/',
            'date_depart' => 'required|date',
            'nb_place' => 'required|integer|min:1|max:7',
            'ecologique_filtre' => 'nullable|in:Oui,Non',
            'prix_max' => 'nullable|numeric|min:0|max:100',
            'duree_max' => 'nullable|date_format:H:i',
            'note_minimale' => 'nullable|integer|min:1|max:5',
        ]);

        try {
            $query = Covoiturage::with('utilisateur', 'voiture')
                ->where('lieu_depart', 'LIKE', '%' . $validated['lieu_depart'] . '%')
                ->where('lieu_arrivee', 'LIKE', '%' . $validated['lieu_arrivee'] . '%')
                ->whereDate('date_depart', '>=', $validated['date_depart'])
                ->where('nb_place', '>=', $validated['nb_place'])
                ->where('statut', 'disponible')
                ->orderby('date_depart');

            if ($request->filled('ecologique_filtre') && $validated['ecologique_filtre'] === 'Oui') {
                $query->whereHas('voiture', function ($q) {
                    $q->where('energie', 'Oui');
                });
            }

            if ($request->filled('prix_max')) {
                $query->where('prix_personne', '<=', $validated['prix_max']);
            }

            if ($request->filled('duree_max')) {
                $query->whereRaw("TIMEDIFF(heure_arrivee, heure_depart) <= ?", [$validated['duree_max']]);
            }

            if ($request->filled('note_minimale')) {
                $query->whereHas('utilisateur.avis', function ($q) use ($validated) {
                    $q->select(DB::raw('AVG(note) as moyenne'))->groupBy('utilisateur_id')
                        ->havingRaw('AVG(note) >= ?', [$validated['note_minimale']]);
                });
            }

            $covoiturages = $query->get();

            return view('covoiturages', [
                'covoiturages' => $covoiturages,
                'lieu_depart' => $validated['lieu_depart'],
                'lieu_arrivee' => $validated['lieu_arrivee'],
                'date_depart' => $validated['date_depart'],
                'nb_place' => $validated['nb_place'],
                'recherche' => true,
                'ecologique_filtre' => $validated['ecologique_filtre'] ?? 'Non',
                'prix_max' => $validated['prix_max'] ?? 100,
                'duree_max' => $validated['duree_max'] ?? '23:59',
                'note_minimale' => $validated['note_minimale'] ?? 1,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la recherche de covoiturage : '.$e->getMessage());
            return redirect()->back()->withInput()->withErrors(['general' => 'Une erreur est survenue lors de la recherche. Veuillez réessayer.']);
        }
    }

    //Delete a ride
    public function annulerVoyage($voiture_id)
    {
        try {
            $voyage = Covoiturage::findOrFail($voiture_id);

            if ($voyage->utilisateur_id !== Auth::id()) {
                return response()->json(['message' => 'Non autorisé.'], 403);
            }
            if ($voyage->statut !== 'disponible') {
                return response()->json(['message' => 'Le voyage ne peut pas être annulé.'], 400);
            }
            $voyage->statut = 'annulé';
            $voyage->save();

            return response()->json(['message' => 'Voyage annulé.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de l\'annulation du voyage.'], 500);
        }
    }
}
