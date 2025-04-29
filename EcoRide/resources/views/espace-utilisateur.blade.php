@extends('layouts.app')

@section('content')

    <form action="{{ route('utilisateur.deconnexion') }}" method="POST">
        @csrf
        <button type="submit">DECONNEXION</button>
    </form>

    <div>
            <p id="pseudo"></p>   
            <p id="nom"></p>
            <p id="prenom"></p>
            <p id="email"></p>
            <p id="telephone"></p>
            <p id="adresse"></p>
            <p id="date_naissance"></p>
            <p id="photo"></p>
    </div>

    <script>

        let nom = @json(Auth::user()->nom);
        document.getElementById("nom").textContent = nom || 'Non défini';

        let pseudo = @json(Auth::user()->pseudo);
        document.getElementById("pseudo").textContent = pseudo || 'Non défini';

        let prenom = @json(Auth::user()->prenom);
        document.getElementById("prenom").textContent = prenom || 'Non défini';

        let email = @json(Auth::user()->email);
        document.getElementById("email").textContent = email || 'Non défini';

        let telephone = @json(Auth::user()->telephone);
        document.getElementById("telephone").textContent = telephone || 'Non défini';

        let adresse = @json(Auth::user()->adresse);
        document.getElementById("adresse").textContent = adresse || 'Non défini';

        let date_naissance = @json(Auth::user()->date_naissance);
        document.getElementById("date_naissance").textContent = date_naissance || 'Non défini';

        let photo = @json(Auth::user()->photo);
        document.getElementById("photo").textContent = photo || 'Non défini';

    </script>

@endsection