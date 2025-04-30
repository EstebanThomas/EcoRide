<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateurs;
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
        return view('espace-utilisateur');
    }

    //createAccount Form
    public function createAccount(Request $request)
    {
        $validated = $request->validate([
            'pseudo' => 'required',
            'mail' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|min:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/\d/'
        ]);

        $user = Utilisateurs::create([
            'pseudo'=> $validated['pseudo'],
            'email' => $validated['mail'],
            'password' => Hash::make($validated['password'])
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
            'pseudo' => 'string|max:50|nullable',
            'password' => 'min:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/\d/|nullable',
            'nom' => 'string|max:50|nullable',
            'prenom' => 'string|max:50|nullable',
            'telephone' => 'string|regex:/^\d{10}$/|nullable',
            'adresse' => 'string|max:50|nullable',
            'date_naissance' => 'date|before:today|before:-18 years|nullable',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
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

        DB::table('Utilisateurs')
            ->where('utilisateur_id', Auth::id())
            ->update($validated);

        return redirect()->route('espaceUtilisateur');
    }
}
