@extends('layouts.app')

@section('content')

    <form action="{{ route('utilisateur.deconnexion') }}" method="POST">
        @csrf
        <button type="submit">DECONNEXION</button>
    </form>

    <div>
        {{Auth::user()->pseudo}}
        {{Auth::user()->nom}}
        {{Auth::user()->prenom}}
        {{Auth::user()->email}}
        {{Auth::user()->telephone}}
        {{Auth::user()->adresse}}
        {{Auth::user()->date_naissance}}
        {{Auth::user()->photo}}
    </div>

@endsection