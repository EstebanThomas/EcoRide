<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateurs;
use App\Models\Voiture;
use App\Models\Marque;
use App\Models\Preferences;
use App\Models\Covoiturage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

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

    public function showProfile()
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
            $participants = json_decode($voyage->participants, true);
            return is_array($participants) && in_array($utilisateur->utilisateur_id, $participants);
        });

        $voyagesHistory = $voyages->merge($participationVoyages);

        return view('/espace-utilisateur', [
            'preferences' => $preferences,
            'marques' => $marques,
            'voitures' => $voitures,
            'voyages' => $voyages,
            'voyagesHistory' => $voyagesHistory,
            'utilisateur' => $utilisateur,
        ]);
    }

    //createAccount Form
    public function createAccount(Request $request)
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
            'credits' => 20
        ]);

        Auth::login($user);

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
}
