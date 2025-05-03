@extends('layouts.app')

@section('content')

    <div class="flex flex-col justify-center items-center m-75 xl:mt-5">

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
                    <button id="chauffeur/passager" class="text-4xl tracking-wide font-second flex flex-col justify-center items-center border-4 border-green1 rounded-3xl p-3"></button>
                </div>
            </div>

        </div>

        <!--Buttons section chauffeur-->
        <div id="sectionChauffeur" class="flex-row justify-center items-center w-200 p-5 mt-10 mb-10 gap-4 bg-green4 rounded-3xl hidden">
            <button id="sectionVehicules" onclick="ShowSection('sectionVehicules'); afficherVehicules();" class="text-4xl font-second tracking-wide text-center hover:text-green1">
            Véhicules
            </button>
            <button id="sectionPreferences" onclick="ShowSection('sectionPreferences')" class="text-4xl font-second tracking-wide text-center hover:text-green1">
            Préférences
            </button>
            <button id="sectionPropresPreferences" onclick="ShowSection('sectionPropresPreferences')" class="text-4xl font-second tracking-wide text-center hover:text-green1">
            Propres préférences
            </button>
            <button id="sectionSaisirVoyage" onclick="ShowSection('sectionSaisirVoyage')" class="text-4xl font-second tracking-wide text-center hover:text-green1">
            Saisir un voyage
            </button>
            <button id="sectionHistorique" onclick="ShowSection('sectionHistorique')" class="text-4xl font-second tracking-wide text-center hover:text-green1">
            Historique
            </button>
            <button id="start/stop" class="text-4xl tracking-wide text-center font-second border-2 border-green1"></button>
        </div>

        <!--Sections chauffeur-->
        <div id="sections" class="hidden">

            <div id="sectionVehicules" class="section flex-col justify-center w-200 xl:w-300 h-250 p-5 mt-5 mb-10 gap-4 bg-green4 rounded-3xl hidden">

                <div class="flex flex-col border-2 border-green1 w-full h-150 rounded-3xl p-2">
                    <p class="flex justify-center items-center font-second text-3xl">Mes véhicules</p>
                    <div id="vehiculeCards" class="flex mt-5 gap-5 overflow-x-auto"></div>
                </div>

                <form class="flex flex-col justify-center items-center gap-5 mt-5 ml-5 mr-5" method="POST" action="{{ route('vehicule.ajouter') }}">

                    @csrf

                    <div class="flex justify-center items-center gap-2">
                        <label for="modele" class="font-second text-3xl">MODELE :</label>
                        <input type="text" id="modele" name="modele" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="immatriculation" class="font-second text-3xl">IMMATRICULATION :</label>
                        <input type="text" id="immatriculation" name="immatriculation" required pattern="^[A-Z]{2}-\d{3}-[A-Z]{2}$" oninvalid="this.setCustomValidity('Format attendu : AB-123-CD')"
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center uppercase"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="datePremiereImmatriculation" class="font-second text-3xl">DATE DE LA PREMIERE IMMATRICULATION :</label>
                        <input type="date" id="datePremiereImmatriculation" name="datePremiereImmatriculation" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="couleur" class="font-second text-3xl">COULEUR :</label>
                        <input type="text" id="couleur" name="couleur" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="energie" class="font-second text-3xl">ENERGIE ELECTRIQUE :</label>
                        <input type="checkbox" id="energie" name="energie"
                        class="text-green1 accent-green1 w-8 h-8 font-second text-4xl xl:text-3xl placeholder-black p-1 items-center"/>
                    </div>

                    <button type="submit" class="text-4xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3">AJOUTER</button>

                </form>
            </div>

            <div id="sectionPreferences" class="section flex-row justify-center items-center w-200 xl:w-300 p-5 mt-5 mb-10 gap-4 bg-green4 rounded-3xl hidden">
            <p>Preferences</p>
            </div>

            <div id="sectionPropresPreferences" class="section flex-row justify-center items-center w-200 xl:w-300 p-5 mt-5 mb-10 gap-4 bg-green4 rounded-3xl hidden">
            <p>Propres Preferences</p>
            </div>

            <div id="sectionSaisirVoyage" class="section flex-row justify-center items-center w-200 xl:w-300 p-5 mt-5 mb-10 gap-4 bg-green4 rounded-3xl hidden">
            <p>Saisir un voyage</p>
            </div>

            <div id="sectionHistorique" class="section flex-row justify-center items-center w-200 xl:w-300 p-5 mt-5 mb-10 gap-4 bg-green4 rounded-3xl hidden">
            <p>Historique</p>
            </div>
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
        imgButton.style.width = '100%';

        const sectionChauffeur = document.getElementById("sectionChauffeur");

        chauffeurPassagerButton.addEventListener('click', function() {
            if (chauffeurPassagerButton.innerText === "Passager") {
                chauffeurPassagerButton.textContent = 'Chauffeur';
                imgButton.src = "{{ asset('images/Chauffeur.svg') }}";
                imgButton.alt = 'Logo chauffeur';
                chauffeurPassagerButton.appendChild(imgButton);
                sectionChauffeur.classList.toggle('hidden');
                sectionChauffeur.classList.toggle('flex');
                sections.classList.toggle('hidden');
            }
            else{
                chauffeurPassagerButton.textContent = 'Passager';
                imgButton.src = "{{ asset('images/Passager.svg') }}";
                imgButton.alt = 'Logo passager';
                chauffeurPassagerButton.appendChild(imgButton);
                sectionChauffeur.classList.toggle('hidden');
                sectionChauffeur.classList.toggle('flex');
                sections.classList.toggle('hidden');
            }
        });

        //Show/Hide sections
        function ShowSection(id){
            const sections = document.querySelectorAll('.section');
            const buttons = sectionChauffeur.querySelectorAll('button');
            sections.forEach(section => {
                if (section.id === id){
                    section.classList.remove('hidden')
                    section.classList.add('flex')
                }
                else if (!section.classList.contains('hidden')){
                    section.classList.add('hidden')
                    section.classList.remove('flex')
                }
            })

            buttons.forEach(button => {
                if (button.id === id){
                    button.classList.add('underline', 'decoration-green1', 'decoration-6', 'xl:decoration-4');
                }
                else{
                    button.classList.remove('underline', 'decoration-green1', 'decoration-6', 'xl:decoration-4');
                }
            });
        };

        //Show car card
        function afficherVehicules() {
            fetch('/api/vehicules')
            .then(res => res.json())
            .then(vehicules => {
            const container = document.getElementById('vehiculeCards');
            container.innerHTML = ''; //Clean

            vehicules.forEach(vehicule => {

                const card = document.createElement('div');
                card.className = "border-2 border-green1 shadow-md rounded-3xl p-4 w-70 h-115 flex-shrink-0";
                    card.innerHTML = `
                    <h2 class="flex justify-center text-4xl font-second mb-2">${vehicule.modele}</h2>
                    <p class="text-3xl font-second">Immatriculation :<br>${vehicule.immatriculation}</p>
                    <p class="text-3xl font-second">Couleur :<br>${vehicule.couleur}</p>
                    <p class="text-3xl font-second">Énergie électrique :<br>${vehicule.energie}</p>
                    <p class="text-3xl font-second">Date 1ère immatriculation :<br>${vehicule.date_premiere_immatriculation}</p>
                    <button type:"submit" class="block mx-auto mt-5 text-4xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3" onclick="supprimerVehicule(${vehicule.vehicule_id})">
                    SUPPRIMER
                    </button>
                `;
                container.appendChild(card);
            });
        });
        }

        //Delete a car
        function supprimerVehicule(vehicule_id) {

        }

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