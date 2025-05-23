<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateurs;
use App\Models\Voiture;
use App\Models\Marque;
use App\Models\Preferences;
use App\Models\Covoiturage;
use App\Models\Avis;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\MongoService;

class UtilisateurController extends Authenticatable
{

    //Views
    public function showHome()
    {
        return view('home');
    }

    public function showCreationAccount()
    {
        return view('creation-compte');
    }

    public function showConnexion()
    {
        return view('connexion');
    }

    public function showProfile(MongoService $mongoService)
    {
        //Get preferences for placeholders
        $preferences = Preferences::where('utilisateur_id', Auth::id())->first();

        $marques = Marque::all();

        $voitures = Voiture::where('utilisateur_id', Auth::id())->get();

        $utilisateur = Auth::user();

        $voyages = Covoiturage::with('voiture')
            ->where('utilisateur_id', $utilisateur->utilisateur_id)
            ->get();

        $allCovoiturages = Covoiturage::with(['voiture', 'utilisateur'])
            ->where('date_depart', '>', now())
            ->get();

        $participationVoyages = $allCovoiturages->filter(function ($voyage) use ($utilisateur){
            $participants = $voyage->participants ?? [];

            // if (!is_array($participants)) {
            //     $participants = [];
            // }

            // $participants = array_map('intval', $participants);

            return is_array($participants) && in_array((int)$utilisateur->utilisateur_id, array_map('intval', $participants));
        });

        $voyagesHistory = $voyages->merge($participationVoyages);

        $voyagesHistory->map(function ($voyage){
            $participantID = $voyage->participants ?? [];

                if (!is_array($participantID)) {
                    $participantID = [];
                }

            $voyage->participantUsers = Utilisateurs::whereIn('utilisateur_id', array_map('intval', $participantID))->get();
            return $voyage;
        });

        $avisEnAttente = Avis::where('utilisateur_id', Auth::id())
            ->where('statut', 'en attente')
            ->get();

        $userId = (string) Auth::user()->utilisateur_id;
        $roles = $mongoService->getRoles($userId);

        return view('/espace-utilisateur', [
            'preferences' => $preferences,
            'marques' => $marques,
            'voitures' => $voitures,
            'voyages' => $voyages,
            'voyagesHistory' => $voyagesHistory,
            'utilisateur' => $utilisateur,
            'avisEnAttente' => $avisEnAttente,
            'roles' => $roles,
        ]);
    }

    //createAccount Form
    public function createAccount(Request $request, MongoService $mongoService)
    {
        $validated = $request->validate([
            'pseudo' => 'required|max:20',
            'mail' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|min:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/\d/|confirmed'
        ],[
            'password.confirmed' => 'Les mots de passe ne correspondent pas'
        ]);

        $user = Utilisateurs::create([
            'pseudo'=> $validated['pseudo'],
            'email' => $validated['mail'],
            'password' => Hash::make($validated['password']),
            'credits' => 20,
        ]);

        Auth::login($user);

        $avis = Avis::create([
            'note'=> 5,
            'utilisateur_id' => Auth::user()->utilisateur_id,
            'statut' => 'temporaire',
        ]);

        $mongoService->setRoles($user->utilisateur_id, ['passager']);

        return redirect()->route('espaceUtilisateur');
    }

    //Connexion From
    public function Connexion(Request $request)
    {
        $validated = $request->validate([
            'mail' => 'required|email',
            'password' => 'required'
        ]);

        $user =[
            'email' => $validated['mail'],
            'password' => $validated['password']
        ];

        if (Auth::attempt($user)){
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->suspendu) {
                Auth::logout();
                return back()->with('AccountSuspend', 'Votre compte est suspendu.');
            }

            if($user->role_id === 1){
                $request->session()->flash('redirect_admin', true);
                return redirect()->route('home');
            } elseif ($user->role_id === 2){
                $request->session()->flash('redirect_employe', true);
                return redirect()->route('home');
            }
            return redirect()->route('espaceUtilisateur');
        }
        
        throw ValidationException::withMessages([
            'Erreur' => 'Informations incorrectes'
        ]);
    }

    //Deconnexion
    public function Deconnexion(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken(); //regenerate the csrf token

        return redirect()->route('home');
    }

    //Modify user's datas
    public function modifierInformations(Request $request)
    {
        $validated = $request->validate([
            'pseudo' => 'string|max:20|nullable',
            'password' => 'min:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/\d/|nullable',
            'nom' => 'string|max:50|nullable',
            'prenom' => 'string|max:50|nullable',
            'telephone' => 'string|regex:/^\d{10}$/|nullable',
            'adresse' => 'string|max:50|nullable',
            'date_naissance' => 'date|before:today|before:-18 years|nullable|after_or_equal:1920-01-01',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
        ],[
            'photo.max' => 'La taille de l\'image ne doit pas dépasser 2 Mo.'
        ]);

        //Ignore empty datas
        foreach ($validated as $key => $value) {
            if ($value === null || $value === '') {
                unset($validated[$key]);
            }
        }

        //hash password
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        //photo
        if($request->hasFile('photo')){
            $picture = $request->file('photo');
            $namePicture = uniqid().'.'.$picture->getClientOriginalExtension();

            //Store
            $path = $picture->storeAs('photos', $namePicture, 'public');

            $validated['photo'] = $path;
        }

        if (!empty($validated)){        
            DB::table('Utilisateurs')
                ->where('utilisateur_id', Auth::id())
                ->update($validated);
            return redirect()->route('espaceUtilisateur');
        } else{
            return redirect()->route('espaceUtilisateur');
        }
    }

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
            'datePremiereImmatriculation'=> $validated['datePremiereImmatriculation'],
            'couleur' => $validated['couleur'],
            'energie'=> $validated['energie'],
        ]);

        return redirect()->route('espaceUtilisateur');
    }

    //Admin view
    public function showAdmin(){
        
        $dataCovoiturages = DB::table('covoiturage')
            ->select(DB::raw('DATE(date_depart) as jour'), DB::raw('COUNT(*) as total'))
            ->groupBy('jour')
            ->orderBy('jour', 'asc')
            ->get();

        $dataCommission = DB::table('commission')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(montant) as total_credits'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        $utilisateurs = Utilisateurs::where('role_id', 2)->get();

        return view('espace-administrateur',[
            'utilisateurs' => $utilisateurs,
            'dataCovoiturages' => $dataCovoiturages,
            'dataCommission' => $dataCommission,
        ]);
    }

    //Employee view
    public function showEmploye(){
        $avisValidation = Avis::where('statut', 'validation')->with(['utilisateur', 'covoiturage', 'covoiturage.utilisateur'])->get();
        $covoituragesProblemes = Covoiturage::whereHas('avis', function($query){
            $query->where('good_trip', false);
            })
            ->with(['avis' => function ($query) {
                $query->where('good_trip', false)->with('utilisateur');
            }])
            ->get();



        return view('espace-employe',[
            'avisValidation' => $avisValidation,
            'covoituragesProblemes' => $covoituragesProblemes,
        ]);
    }

    public function showAdminWithMessage($message, $text){
        $dataCovoiturages = DB::table('covoiturage')
            ->select(DB::raw('DATE(date_depart) as jour'), DB::raw('COUNT(*) as total'))
            ->groupBy('jour')
            ->orderBy('jour', 'asc')
            ->get();

        $dataCommission = DB::table('commission')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(montant) as total_credits'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        $utilisateurs = Utilisateurs::where('role_id', 2)->get();
        return view('espace-administrateur',array_merge([
            'utilisateurs' => $utilisateurs,
            'dataCovoiturages' => $dataCovoiturages,
            'dataCommission' => $dataCommission,
        ], [
            $message => $text

        ]));
    }

    //Creation account employe
    public function createAccountEmploye(Request $request){
        try{
                $validated = $request->validate([
                'pseudo' => 'required|max:20',
                'mail' => 'required|email|unique:utilisateurs,email',
                'password' => 'required|min:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/\d/'
            ]);
            $user = Utilisateurs::create([
                'pseudo'=> $validated['pseudo'],
                'email' => $validated['mail'],
                'password' => Hash::make($validated['password']),
                'role_id' => 2,
            ]);

            return $this->showAdminWithMessage('successCreateAccount', 'Compte employé créé !');
        } catch (\Exception){

            return $this->showAdminWithMessage('errorCreateAccount', 'Erreur lors de la création du compte !');
        }
    }

    //suspend an account
    public function suspendreCompte($id)
    {
        try{

            $user = Utilisateurs::findOrFail($id);
            
            if($user->role_id ===1 ){
                return $this->showAdminWithMessage('errorSuspend', 'Une erreur est survenue !');
            }

            $user->suspendu = true;
            $user->save();


            return $this->showAdminWithMessage('successDesactivate', 'Le compte est suspendu.');
        } catch(\Exception){

            return $this->showAdminWithMessage('errorSuspend', 'Une erreur est survenue !');
        }
        

    }

    //activate an account
    public function activerCompte($id)
    {
        try{
            $user = Utilisateurs::findOrFail($id);
            $user->suspendu = false;
            $user->save();

            return $this->showAdminWithMessage('successActivate', 'Le compte est réactivé.');
        } catch(\Exception $e){

            return $this->showAdminWithMessage('errorSuspend', 'Une erreur est survenue !');
        }
    }

    //Search user
    public function afficherUtilisateurParEmail(Request $request)
    {
        try{
            $request->validate(['email' => 'required|email']);

            $utilisateurSearch = Utilisateurs::where('email', $request->email)->first();

            if ($utilisateurSearch) {
                $utilisateurs = Utilisateurs::where('role_id', 2)->get();
                $dataCovoiturages = DB::table('covoiturage')
                    ->select(DB::raw('DATE(date_depart) as jour'), DB::raw('COUNT(*) as total'))
                    ->groupBy('jour')
                    ->orderBy('jour', 'asc')
                    ->get();

                $dataCommission = DB::table('commission')
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(montant) as total_credits'))
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->orderBy('date')
                    ->get();

                return view('espace-administrateur', [
                    'utilisateurs' => $utilisateurs,
                    'utilisateurSearch' => $utilisateurSearch,
                    'successSearch' => 'Recherche effectuée !',
                    'dataCovoiturages' => $dataCovoiturages,
                    'dataCommission' => $dataCommission,
                ]);
            } else {
                return $this->showAdminWithMessage('errorSuspend', 'Une erreur est survenue !');
            }
        } catch (\Exception){
            return $this->showAdminWithMessage('errorSuspend', 'Une erreur est survenue !');
        }
    }

    //Create review
    public function avisCreate(Request $request)
    {
        try {
            $validated = $request->validate([
                'covoiturage_id' => 'required|exists:covoiturage,covoiturage_id',
                'commentaire' => 'required|string|max:255',
                'note' => 'required|integer|min:1|max:5',
                'good_trip' => 'nullable',
            ]);

            $utilisateur_id = Auth::id();

            $avis = Avis::where('utilisateur_id', $utilisateur_id)
                ->where('covoiturage_id', $validated['covoiturage_id'])
                ->where('statut', 'en attente')
                ->first();

            if($avis){
                $covoiturage = Covoiturage::findOrFail($validated['covoiturage_id']);
                $conducteur_id = $covoiturage->utilisateur_id;

                $avis->covoiturage_id = $validated['covoiturage_id'];
                $avis->commentaire = $validated['commentaire'];
                $avis->note = $validated['note'];
                $avis->statut = 'validation';
                $avis->good_trip = $request->has('good_trip'); //checked = true
                $avis->conducteur_id = $conducteur_id;
                $avis->save();
            } else {
                return back()->with('errorAvis', 'Aucun avis en attente trouvé.');
            }

            if($avis->good_trip){
                $driver = $covoiturage->utilisateur;
                $driver->credits += $covoiturage->prix_personne; 
                $driver->save();
            }

            return back()->with('successAvis', 'Votre avis a bien été enregistré, il sera validé par un employé avant sa publication.');
        } catch (\Exception $e) {
            return back()->with('errorAvis', 'Une erreur est survenue lors de l\'enregistrement de votre avis : ' . $e->getMessage());
        }
    }

    public function avisValider($avis_id, $covoiturage_id)
    {
        try {
            $avis = Avis::findOrFail($avis_id);
            $covoiturage = Covoiturage::findOrFail($covoiturage_id);

            $avis->statut = 'valide';
            $avis->save();

            $avisTemp = Avis::where('utilisateur_id', $covoiturage->utilisateur_id)
                            ->where('statut', 'temporaire')
                            ->first();

            if ($avisTemp) {
                $avisTemp->delete();
            }

            //Update notation in utilisateurs
            $conducteurId = $avis->conducteur_id;
            $conducteur = Utilisateurs::find($conducteurId);

            $moyenne = Avis::where('conducteur_id', $conducteurId)
                            ->where('statut', 'valide')
                            ->avg('note');
            
            $conducteur->note = $moyenne;
            $conducteur->save();

            return redirect()->route('home')->with('successAvis', 'L\'avis a été validé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('errorAvis', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function avisRefuser($id)
    {
        try {
            $avis = Avis::findOrFail($id);
            $avis->statut = 'refuse';
            $avis->save();

            return redirect()->route('home')->with('successAvisRefus', 'L\'avis a été refusé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('errorAvis', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function avisResolu($avis_id, $covoiturage_id)
    {
        try {
            $covoiturage = Covoiturage::findOrFail($covoiturage_id);

            $avisTemp = Avis::where('utilisateur_id', $covoiturage->utilisateur_id)
                            ->where('statut', 'temporaire')
                            ->first();

            if ($avisTemp) {
                $avisTemp->delete();
            }

            $avis = Avis::findOrFail($avis_id);
            $avis->good_trip = true;
            $avis->save();

            //Give credits to driver
            $driver = $covoiturage->utilisateur;
            $driver->credits += $covoiturage->prix_personne; 
            $driver->save();

            return redirect()->route('home')->with('successAvis', 'L\'avis a été validé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('errorAvis', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
}
