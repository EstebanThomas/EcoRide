@extends('layouts.app')

@section('content')
    <div>
        <h1>
            ESPACE UTILISATEUR
        </h1>
        <h2>{{Auth::utilisateurs()->pseudo}}</h2>
        <h2>{{Auth::utilisateurs()->email}}</h2>
        <h2>{{Auth::utilisateurs()->nom}}</h2>
        <h2>{{Auth::utilisateurs()->prenom}}</h2>
        <h2>{{Auth::utilisateurs()->telephone}}</h2>
        <h2>{{Auth::utilisateurs()->adresse}}</h2>
        <h2>{{Auth::utilisateurs()->date_naissance}}</h2>
        <h2>{{Auth::utilisateurs()->photo}}</h2>

        <form action="{{route('deconnexion')}}" method="POST">
        @csrf
        <button type="submit">Déconnexion</button>
        </form>
    </div>
@endsection