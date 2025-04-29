<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateurs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\ValidationException;

class UtilisateurController extends Authenticatable
{

    //Views
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
            'password' => 'required|text'
        ]);

        if (Auth::attempt($validated)){
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

        return redirect()->route('connexion');
    }
}
