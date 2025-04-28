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
    public function createAccount(Request $request)
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

        return redirect('/espace-utilisateur');
    }
}
