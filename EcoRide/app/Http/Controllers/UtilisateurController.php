<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateurs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UtilisateurController extends Controller
{
    //Send createAccount Form
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pseudo' => 'required',
            'mail' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|min:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/\d/'
        ]);

        Utilisateurs::create([
            'pseudo'=> $validated['pseudo'],
            'email' => $validated['mail'],
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('espace-utilisateur')->with('success', 'Formulaire envoyé avec succès.');
    }

    //Connexion
    public function connexion(Request $request)
    {
        $validated = $request->validate([
            'pseudo' => 'required',
            'mail' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|min:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/\d/'
        ]);

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])){
            $request->session()->regenerate();
            return redirect()->intended('/espace-utilisateur');
        }

        return back()->withErrors(['email'=> 'Les information sont incorrectes.']);
    }

    //Deconnexion
    public function deconnexion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home');
    }
}
