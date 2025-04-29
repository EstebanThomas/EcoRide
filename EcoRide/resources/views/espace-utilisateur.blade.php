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

    <div>
        <button id="chauffeur/passager" class="flex flex-col justify-center items-center w-50 h-50 border-2 border-green1 rounded-3xl"></button>
    </div>

    <script>

        //User's informations

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


    //Select chauffeur/passager
    const chauffeurPassagerButton = document.getElementById("chauffeur/passager");

    const imgButton = document.createElement('img');
    
    chauffeurPassagerButton.textContent = 'Passager';
    imgButton.src = "{{ asset('images/Passager.svg') }}";
    imgButton.alt = 'Logo passager';
    chauffeurPassagerButton.appendChild(imgButton);
    imgButton.style.width = '50%';

    chauffeurPassagerButton.addEventListener('click', function() {
        if (chauffeurPassagerButton.innerText ==="Passager") {
            chauffeurPassagerButton.textContent = 'Chauffeur';
            imgButton.src = "{{ asset('images/Chauffeur.svg') }}";
            imgButton.alt = 'Logo chauffeur';
            chauffeurPassagerButton.appendChild(imgButton);
        }
        else{
            chauffeurPassagerButton.textContent = 'Passager';
            imgButton.src = "{{ asset('images/Passager.svg') }}";
            imgButton.alt = 'Logo passager';
            chauffeurPassagerButton.appendChild(imgButton);
        }
    });

    </script>

@endsection