@extends('layouts.app')

@section('content')

    <div class="flex flex-col justify-center items-center m-75">

        <div class="flex flex-col justify-center items-center gap-10 border-2 border-green1 rounded-3xl p-5 w-200">

            <form class="flex flex-col justify-center items-center gap-5 ml-5 mr-5" method="POST" action="{{ route('utilisateur.modifier') }}">

                @csrf

                <div class="flex justify-center items-center gap-2">
                    <label for="pseudo" class="font-second text-3xl">PSEUDO :</label>
                    <input type="text" id="pseudo" name="pseudo"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="nom" class="font-second text-3xl">NOM :</label>
                    <input type="text" id="nom" name="nom"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="prenom" class="font-second text-3xl">PRENOM :</label>
                    <input type="text" id="prenom" name="prenom"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="email" class="font-second text-3xl">EMAIL :</label>
                    <input type="email" id="email" name="email"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="telephone" class="font-second text-3xl">TELEPHONE :</label>
                    <input type="string" id="telephone" name="telephone"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="adresse" class="font-second text-3xl">ADRESSE :</label>
                    <input type="string" id="adresse" name="adresse"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="date_naissance" class="font-second text-3xl">DATE DE NAISSANCE :</label>
                    <input type="date" id="date_naissance" name="date_naissance"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <p class="text-4xl font-second tracking-wide">photo :</p>
                    <p id="photo" class="text-4xl font-second tracking-wide bg-green4"></p>
                </div>

                <button type="submit" class="text-4xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3">MODIFIER</button>

            </form>


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
        document.getElementById("nom").placeholder = nom || 'Non défini';

        let pseudo = @json(Auth::user()->pseudo);
        document.getElementById("pseudo").placeholder = pseudo || 'Non défini';

        let prenom = @json(Auth::user()->prenom);
        document.getElementById("prenom").placeholder= prenom || 'Non défini';

        let email = @json(Auth::user()->email);
        document.getElementById("email").placeholder = email || 'Non défini';

        let telephone = @json(Auth::user()->telephone);
        document.getElementById("telephone").placeholder = telephone || 'Non défini';

        let adresse = @json(Auth::user()->adresse);
        document.getElementById("adresse").placeholder = adresse || 'Non défini';

        let date_naissance = @json(Auth::user()->date_naissance);
        document.getElementById("date_naissance").placeholder = date_naissance || 'Non défini';

        let photo = @json(Auth::user()->photo);
        document.getElementById("photo").placeholder = photo || 'Non défini';


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