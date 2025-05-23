<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Covoiturage;
use App\Models\Avis;
use Illuminate\Http\Request;
use App\Models\Preferences;
use App\Models\Voiture;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;  
use App\Models\Utilisateurs;
use App\Models\Commission;
use App\Mail\VoyageAnnule;
use App\Mail\VoyageTermine;
use Illuminate\Support\Facades\Mail;

class CovoiturageController extends Controller
{

    public function showCovoiturage()
    {
        $covoiturages = Covoiturage::where('statut', 'disponible')->with('utilisateur', 'avis')->get();

        $utilisateur= Auth::user();

        return view('covoiturages', [
            'covoiturages' => $covoiturages,
            'utilisateur' => $utilisateur,
        ]);
    }

    public function showRideDetails($id){
        try{
            $covoiturage = Covoiturage::with('utilisateur', 'voiture', 'voiture.marque', 'utilisateur.preferences')
            ->where('covoiturage_id', $id)
            ->firstOrFail();

            $user = Auth::user();

            $participants = $covoiturage->participants ?? [];

            if (is_string($participants)) {
                $participants = json_decode($participants, true);
            }

            if (!is_array($participants)) {
                $participants = [];
            }

            $alreadyParticipating = $user && in_array($user->utilisateur_id, $participants);

            $driver = $covoiturage->utilisateur;

            $avis = Avis::where('statut', 'valide')
                ->whereHas('covoiturage', function($query) use ($driver){
                    $query->where('utilisateur_id', $driver->utilisateur_id);
                })
                ->with(['utilisateur', 'covoiturage'])
                ->get();

            return view('details', [
                'covoiturage' => $covoiturage,
                'alreadyParticipating' => $alreadyParticipating,
                'user' => $user,
                'avis' => $avis,
            ]);
        } catch (\Exception) {
            return redirect()->back()->withErrors(['message' => 'Une erreur est survenue lors de la récupération des détails. Veuillez réessayer.']);
        }
    }

    //Add a ride
    public function ajouterCovoiturage(Request $request)
    {
        $today = now()->startOfDay();
        $maxDate = now()->addMonth(2)->endOfDay();

        $validated = $request->validate([
            'date_depart' => 'required|date|after_or_equal:'.$today.'|before_or_equal:'.$maxDate,
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
            'note_minimale' => 'nullable|integer|min:0|max:5',
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
                $query->whereHas('utilisateur', function ($q) use ($validated) {
                    $q->where('note', '>=', $validated['note_minimale']);
                });
            }

            $covoiturages = $query->get();
            $utilisateur = Auth::user();

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
                'utilisateur' => $utilisateur
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la recherche de covoiturage : '.$e->getMessage());
            return redirect()->back()->withInput()->withErrors(['general' => 'Une erreur est survenue lors de la recherche. Veuillez réessayer.']);
        }
    }

    //Cancel a ride
    public function annulerVoyage($covoiturage_id)
    {
        try {
            $voyage = Covoiturage::findOrFail($covoiturage_id);

            if ($voyage->utilisateur_id !== Auth::id()) {
                return response()->json(['message' => 'Non autorisé.'], 403);
            }
            if (in_array($voyage->statut, ['annulé', 'terminé'])) {
                return response()->json(['message' => 'Le voyage ne peut pas être annulé.'], 400);
            }
            $voyage->statut = 'annulé';
            $voyage->save();

            $participants = $voyage->participants ?? [];

            foreach ($participants as $participantId) {
                $utilisateur = Utilisateurs::find($participantId);
                if ($utilisateur) {
                    $utilisateur->credits += $voyage->prix_personne;
                    $utilisateur->save();
                    
                    try{
                        Mail::to($utilisateur->email)->send(new VoyageAnnule($utilisateur, $voyage));
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail à {$utilisateur->email} : " . $e->getMessage());
                    }
                    
                }
            }

            return response()->json(['message' => 'Voyage annulé.'], 200);
        } catch (\Exception) {
            return response()->json(['message' => 'Erreur lors de l\'annulation du voyage.'], 500);
        }
    }

    //Participate in a ride
    public function participerCovoiturage($id)
    {
        try {
            $user = Auth::user();
            $covoiturage = Covoiturage::find($id);
            $participants = $covoiturage->participants ?? [];

            if (is_string($participants)) {
                $participants = json_decode($participants, true);
            }

            if (!is_array($participants)) {
                $participants = [];
            }
            
            if (!$user){
                return redirect()->route('page.connexion');
            }

            if($covoiturage->nb_place <= 0){
                return back()->with('errorParticipation', 'Il n\'y a plus de places disponibles.');
            }

            $errorDriver = DB::table('covoiturage')
                ->where('date_depart', '>', now()) //Search in future rides
                ->where('covoiturage_id', "=", $covoiturage->covoiturage_id) //On this ride
                ->where('utilisateur_id', $user->utilisateur_id) //is the driver
                ->exists();

            if ($errorDriver) {
                return back()->with('errorParticipation', 'Un conducteur ne peut pas participer à son propre trajet.');
            }

            if ($user->utilisateur_id === $covoiturage->utilisateur_id) {
                return back()->with('errorParticipation', 'Un conducteur ne peut pas participer à son propre trajet.');
            }

            if ($user->credits < $covoiturage->prix_personne){
                return back()->with('errorParticipation', 'Vous n\'avez pas assez de crédits pour rejoindre ce covoiturage, vous avez ' . $user->credits . ' crédits.');
            }

            $participants[] = $user->utilisateur_id;

            $covoiturage->participants = $participants;
            $covoiturage->nb_place -= 1;
            $covoiturage->save();

            DB::table('utilisateurs')
                ->where('utilisateur_id', $user->utilisateur_id)
                ->decrement('credits', $covoiturage->prix_personne);

            if($covoiturage->nb_place <= 0){
                $covoiturage->statut = "plein";
                $covoiturage->save();
            }
            return redirect()->route('espaceUtilisateur')->with('successParticipation', 'Vous avez rejoint ce covoiturage !');
        } catch (\Exception $e){
            Log::error('Erreur lors de la participation au covoiturage : '.$e->getMessage());
            return back()->with('errorParticipation', 'Une erreur est survenue lors de la participation. Veuillez réessayer.');
        }
        
    }

    //Leave a ride
    public function quitterCovoiturage($id)
    {
        try {
            $user = Auth::user();
            $covoiturage = Covoiturage::find($id);
            $participants = $covoiturage->participants ?? [];

            if (is_string($participants)) {
                $participants = json_decode($participants, true);
            }

            if (!is_array($participants)) {
                $participants = [];
            }

            if (!in_array($user->utilisateur_id, $participants)){
                return back()->with('errorParticipation', 'Vous ne participez pas à ce covoiturage.');
            }

            $participants = array_values(array_diff($participants, [$user->utilisateur_id]));
            $covoiturage->participants = json_encode($participants);
            $covoiturage->nb_place += 1;
            $covoiturage->save();

            if($covoiturage->statut === "plein"){
                $covoiturage->statut = "disponible";
                $covoiturage->save();

                DB::table('utilisateurs')
                    ->where('utilisateur_id', $user->utilisateur_id)
                    ->increment('credits', $covoiturage->prix_personne);

                return back()->with('successParticipation', 'Vous avez quitté ce covoiturage, il est maintenant disponible.');
            }

            DB::table('utilisateurs')
                ->where('utilisateur_id', $user->utilisateur_id)
                ->increment('credits', $covoiturage->prix_personne);

            return back()->with('successParticipation', 'Vous avez quitté ce covoiturage.');
        } catch (\Exception){
            return back()->with('errorParticipation', 'Une erreur est survenue lors de l\'annulation de votre participation. Veuillez réessayer.');
        }
    }

    //Start a ride
    public function demarrerCovoiturage($id)
    {
        try{
            $covoiturage = Covoiturage::find($id);

            $covoiturage->statut = "en cours";
            $covoiturage->save();

            return back()->with('successStart', 'Le voyage a débuté !');
        } catch (\Exception){
            return back()->with('errorStart', 'Une erreur est survenue lors du démarrage du voyage.');
        }
    }

    //Stop a ride
    public function arreterCovoiturage($id)
    {
        try{
            $covoiturage = Covoiturage::find($id);

            $covoiturage->statut = "terminé";
            $covoiturage->save();

            $participants = $covoiturage->participants ?? [];
            $nombreParticipants = is_array($participants) ? count($participants) : 0;

            $driver = $covoiturage->utilisateur;
            $driver->credits -= 2; //For EcoRide
            $driver->save();

            DB::table('utilisateurs')
                ->where('role_id', 1)
                ->increment('credits', 2);

            DB::table('Commission')->insert([
                'utilisateur_id' => $driver->utilisateur_id,
                'montant' => 2,
                'created_at' => now(),
            ]);

            foreach ($participants as $participantId) {
                DB::table('avis')->insert([
                    'utilisateur_id' => $participantId,
                    'covoiturage_id' => $covoiturage->covoiturage_id,
                    'statut' => 'en attente'
                ]);

                $utilisateur = Utilisateurs::find($participantId);

                try{
                    Mail::to($utilisateur->email)->send(new VoyageTermine($utilisateur, $covoiturage));
                } catch (\Exception $e) {
                        Log::error("Erreur envoi mail à {$utilisateur->email} : " . $e->getMessage());
                }
            }

            return back()->with('successStop', 'Le voyage est terminé !');
        } catch(\Exception){
            return back()->with('errorStop', 'Une erreur est survenue lors de l\'arrêt du voyage.');
        }
    }
}
