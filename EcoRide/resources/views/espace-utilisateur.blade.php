@extends('layouts.app')

@section('content')

    <div class="flex flex-col justify-center items-center m-75">

        <div class="flex flex-col justify-center items-center gap-10 border-2 border-green1 rounded-3xl p-5 w-200">

            <div class="flex flex-col justify-center items-start gap-5 ml-5 mr-5">
                <div class="flex justify-center items-center gap-2">
                    <p class="text-4xl font-second tracking-wide">pseudo :</p>
                    <p id="pseudo" class="text-4xl font-second tracking-wide bg-green4"></p>  
                </div>
                <div class="flex justify-center items-center gap-2">
                    <p class="text-4xl font-second tracking-wide">nom :</p>
                    <p id="nom" class="text-4xl font-second tracking-wide bg-green4"></p>
                </div>
                <div class="flex justify-center items-center gap-2">
                    <p class="text-4xl font-second tracking-wide">prenom :</p>
                    <p id="prenom" class="text-4xl font-second tracking-wide bg-green4"></p>
                </div>
                <div class="flex justify-center items-center gap-2">
                    <p class="text-4xl font-second tracking-wide">email :</p>
                    <p id="email" class="text-4xl font-second tracking-wide bg-green4"></p>
                </div>
                <div class="flex justify-center items-center gap-2">
                    <p class="text-4xl font-second tracking-wide">telephone :</p>
                    <p id="telephone" class="text-4xl font-second tracking-wide bg-green4"></p>
                </div>
                <div class="flex justify-center items-center gap-2">
                    <p class="text-4xl font-second tracking-wide">adresse :</p>
                    <p id="adresse" class="text-4xl font-second tracking-wide bg-green4"></p>
                </div>
                <div class="flex justify-center items-center gap-2">
                    <p class="text-4xl font-second tracking-wide">date de naissance :</p>
                    <p id="date_naissance" class="text-4xl font-second tracking-wide bg-green4"></p>
                </div>
                <div class="flex justify-center items-center gap-2">
                    <p class="text-4xl font-second tracking-wide">photo :</p>
                    <p id="photo" class="text-4xl font-second tracking-wide bg-green4"></p>
                </div>
            </div>


            <div class="flex flex-row justify-center items-center gap-10">
                <form action="{{ route('utilisateur.deconnexion') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-4xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3">DECONNEXION</button>
                </form>


                <div>
                    <button id="chauffeur/passager" class="text-4xl tracking-wide font-second flex flex-col justify-center items-center border-2 border-green1 rounded-3xl p-5"></button>
                </div>
            </div>

        </div>

        <div id="sectionChauffeur" class="flex-col justify-center items-center w-150 h-150 mt-10 mb-10 bg-green4 rounded-3xl hidden">
            <p class="text-4xl font-second tracking-wide">Véhicules</p>
            <p class="text-4xl font-second tracking-wide">Préférences</p>
            <p class="text-4xl font-second tracking-wide">Propres préférences</p>
            <p class="text-4xl font-second tracking-wide">Saisir un voyage</p>
            <p class="text-4xl font-second tracking-wide">Historique covoiturages</p>
            <button id="start/stop" class="text-4xl tracking-wide font-second border-2 border-green1"></button>
        </div>

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

        const sectionChauffeur = document.getElementById("sectionChauffeur");

        chauffeurPassagerButton.addEventListener('click', function() {
            if (chauffeurPassagerButton.innerText === "Passager") {
                chauffeurPassagerButton.textContent = 'Chauffeur';
                imgButton.src = "{{ asset('images/Chauffeur.svg') }}";
                imgButton.alt = 'Logo chauffeur';
                chauffeurPassagerButton.appendChild(imgButton);
                sectionChauffeur.classList.toggle('hidden');
                sectionChauffeur.classList.toggle('flex');
            }
            else{
                chauffeurPassagerButton.textContent = 'Passager';
                imgButton.src = "{{ asset('images/Passager.svg') }}";
                imgButton.alt = 'Logo passager';
                chauffeurPassagerButton.appendChild(imgButton);
                sectionChauffeur.classList.toggle('hidden');
                sectionChauffeur.classList.toggle('flex');
            }
        });

        //Start/Stop button
        const startStop = document.getElementById("start/stop");
        startStop.textContent = 'Démarrer';

        startStop.addEventListener('click', function() {
            if (startStop.innerText === "Démarrer") {
                startStop.textContent = 'Arrêter';
            }
            else{
                startStop.textContent = 'Démarrer';
            }
        });

    </script>

@endsection