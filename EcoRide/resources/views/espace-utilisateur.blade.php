@extends('layouts.app')

@section('content')

    <div class="flex flex-col justify-center items-center m-75 mb-10 xl:mt-5">

        <!--REVIEW-->
        @if ($avisEnAttente->isNotEmpty())
            <div class="flex flex-col justify-center items-center gap-1 border-2 border-green1 rounded-3xl p-5 w-200 mb-5">
                <p class="font-second text-5xl xl:text-3xl tracking-wide uppercase text-black">Avis en attente</p>
                @foreach($avisEnAttente as $avis)
                    <div class="border-2 border-green1 m-2 p-2 flex flex-col justify-center items-center rounded-3xl gap-1">
                        @php
                            $covoiturage = $avis->covoiturage;
                            $conducteur = $covoiturage->utilisateur;
                        @endphp
                        <p class="text-4xl xl:text-2xl font-second">Conducteur : {{ $conducteur->pseudo }}</p>
                        <p class="text-4xl xl:text-2xl font-second">De {{ $covoiturage->lieu_depart }} à {{ $covoiturage->lieu_arrivee }}</p>
                        <p class="text-4xl xl:text-2xl font-second">Le {{ \Carbon\Carbon::parse($covoiturage->date_depart)->format('d/m/Y') }}</p>
                        <form action="{{ route('avis.create') }}" method="POST" class="mt-2 flex flex-col justify-center items-center gap-1">
                            @csrf
                            <input type="hidden" name="covoiturage_id" value="{{ $avis->covoiturage_id }}">
                            <textarea name="commentaire" required placeholder="Votre avis..." class="text-4xl xl:text-2xl font-second border-2 border-3xl border-green1 p-1 w-180 h-50"></textarea>
                            <div class="flex justify-center items-center gap-2">
                                <label for="note" class="font-second text-4xl xl:text-2xl tracking-wide">Note :</label>
                                <input type="number" id="note" name="note" min="1" max="5" value="5" required
                                class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl p-1 items-center"/>
                                <img src="{{ asset('images/Note.svg') }}" alt="Logo crédit" class="w-10 h-10">
                                <p class="font-second text-4xl"> (Minimum 1 et maximum 5)</p>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <label for="good_trip" class="font-second text-4xl xl:text-2xl">Cocher cette case si le voyage s'est bien passé :</label>
                                <input type="checkbox" id="good_trip" name="good_trip" checked value="true"
                                class="text-green1 accent-green1 w-8 h-8 font-second text-4xl xl:text-2xl p-1 items-center"/>
                            </div>
                            <button type="submit"
                            class="text-4xl xl:text-2xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3 hover:bg-green2 active:bg-green1">
                                Envoyer
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
        

        <div class="flex flex-col justify-center items-center gap-10 border-2 border-green1 rounded-3xl p-5 w-200">

            <form enctype="multipart/form-data" class="flex flex-col justify-center items-center gap-5 ml-5 mr-5" method="POST" action="{{ route('utilisateur.modifier') }}">

                @csrf

                <div class="flex justify-center items-center gap-2">
                    <label for="pseudo" class="font-second text-3xl xl:text-2xl tracking-wide">PSEUDO :</label>
                    <input type="text" id="pseudo" name="pseudo"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="nom" class="font-second text-3xl xl:text-2xl tracking-wide">NOM :</label>
                    <input type="text" id="nom" name="nom"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="prenom" class="font-second text-3xl xl:text-2xl tracking-wide">PRENOM :</label>
                    <input type="text" id="prenom" name="prenom"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="email" class="font-second text-3xl xl:text-2xl tracking-wide">EMAIL :</label>
                    <input type="email" id="email" name="email"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="telephone" class="font-second text-3xl xl:text-2xl tracking-wide">TELEPHONE :</label>
                    <input type="text" id="telephone" name="telephone"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="adresse" class="font-second text-3xl xl:text-2xl tracking-wide">ADRESSE :</label>
                    <input type="text" id="adresse" name="adresse"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <label for="date_naissance" class="font-second text-3xl xl:text-2xl tracking-wide">DATE DE NAISSANCE :</label>
                    <input type="date" id="date_naissance" name="date_naissance"
                    class="bg-green4 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                </div>

                <div class="flex justify-center items-center gap-2">
                    <p class="text-3xl xl:text-2xl font-second tracking-wide">PHOTO :</p>
                    <input type="file" id="photo" name="photo" accept="image/*"
                    class="text-3xl xl:text-2xl font-second tracking-wide bg-green4 pr-5 rounded-3xl file:mr-4 file:p-2 file:rounded-3xl file:border-0 file:bg-green1 hover:file:bg-green2"/>
                </div>

                @if(Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Photo utilisateur" class="w-40 h-40 rounded-full object-cover">
                @else
                    <img src="{{ asset('images/PhotoDeProfilDefaut.png') }}" alt="Photo utilisateur par défaut" class="w-40 h-40 rounded-full object-cover">
                @endif

                <button type="submit" class="text-4xl xl:text-2xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3 hover:bg-green2 active:bg-green1">ENREGISTRER MODIFICATION</button>

            </form>

            <div class="flex flex-row justify-center items-center gap-10">
                <form action="{{ route('utilisateur.deconnexion') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-4xl xl:text-2xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3 hover:bg-green2 active:bg-green1">DECONNEXION</button>
                </form>

                <div>
                    <button id="chauffeur/passager" 
                    class="text-4xl xl:text-3xl tracking-wide font-second flex flex-col justify-center items-center border-4 border-green1 active:border-green1 rounded-3xl p-3 hover:border-green3">
                    </button>
                </div>

            </div>

            <div>
                <p class="text-4xl xl:text-3xl font-second text-black flex flex-row justify-center items-center">Crédits : {{$utilisateur->credits}} 
                <img src="{{ asset('images/Credit.svg') }}" alt="Logo crédit" class="w-10 h-10"></p>
            </div>

        </div>

        <!--Buttons section chauffeur-->
        <div id="sectionChauffeur" class="flex-row justify-center items-center w-200 p-5 mt-10 mb-10 gap-4 bg-green4 rounded-3xl hidden">
            <button id="sectionVehicules" onclick="ShowSection('sectionVehicules'); afficherVehicules();" class="text-4xl xl:text-2xl font-second tracking-wide text-center hover:text-green1">
            Véhicules
            </button>
            <button id="sectionPreferences" onclick="ShowSection('sectionPreferences')" class="text-4xl xl:text-2xl font-second tracking-wide text-center hover:text-green1">
            Préférences
            </button>
            <button id="sectionSaisirVoyage" onclick="ShowSection('sectionSaisirVoyage')" class="text-4xl xl:text-2xl font-second tracking-wide text-center hover:text-green1">
            Voyages
            </button>
        </div>

        <!--Sections chauffeur-->
        <div id="sections" class="hidden">

            <div id="sectionPreferences" class="section flex-col justify-center w-200 xl:w-300 p-5 mt-5 mb-1 gap-4 bg-green4 rounded-3xl hidden">
                <form class="flex flex-col justify-center items-center gap-5 mt-5 ml-5 mr-5" method="POST" action="{{ route('preferences.ajouter') }}">
                    @csrf
                    <div class="flex justify-center items-center gap-2">
                        <label for="fumeur" class="font-second text-3xl xl:text-2xl">FUMEURS :</label>
                        <input type="checkbox" id="fumeur" name="fumeur"
                        {{ old('fumeur', $preferences->fumeur ?? false) ? 'checked' : '' }}
                        class="text-green1 accent-green1 w-8 h-8 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="animaux" class="font-second text-3xl xl:text-2xl">ANIMAUX :</label>
                        <input type="checkbox" id="animaux" name="animaux"
                        {{ old('animaux', $preferences->animaux ?? false) ? 'checked' : '' }}
                        class="text-green1 accent-green1 w-8 h-8 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex flex-col justify-center items-center gap-2">
                        <label for="propres_preferences" class="font-second text-3xl xl:text-2xl">PROPRES PREFERENCES :</label>
                        <input type="text" id="propres_preferences" name="propres_preferences" maxLength="100"
                        placeholder="{{ $preferences->propres_preferences ?? "nombre de valises, musique, climatisation ..."}}"
                        value="{{ old('propres_preferences', $preferences->propres_preferences ?? '') }}"
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second w-190 xl:w-250 text-4xl xl:text-2xl placeholder-gray-700 p-1 items-center"/>
                    </div>

                    <button type="submit" class="text-4xl xl:text-2xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3 hover:bg-green2">MODIFIER</button>
                </form>

                @if (session('successPreferences'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                title: 'Préférences modifiées !',
                                icon: 'success',
                                showConfirmButton: true,
                                customClass:{
                                    popup: 'custom-swal'
                                }
                            });
                        })
                    </script>
                @endif
            </div>

            <div id="sectionSaisirVoyage" class="section flex-col justify-center items-center w-200 xl:w-300 p-5 mt-5 mb-10 gap-4 bg-green4 rounded-3xl hidden">

                <div class="flex flex-col border-2 border-green1 w-full h-120 rounded-3xl p-2">
                    <p class="flex justify-center items-center font-second text-3xl">Mes voyages</p>
                    <div class="flex mt-5 gap-5 overflow-x-auto">
                        @forelse($voyages as $voyage)
                            @if(in_array($voyage->statut, ['disponible', 'plein', 'en cours']))
                                <div class="min-w-[300px] border-2 border-green1 rounded-3xl p-4 flex-shrink-0">
                                    <h3 class="text-4xl font-second text-green1">De {{ $voyage->lieu_depart }} à {{ $voyage->lieu_arrivee }}</h3>
                                    <p class="text-3xl xl:text-2xl font-second mt-2">Départ : {{ \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') }}</p>
                                    <p class="text-3xl xl:text-2xl font-second">Places : {{ $voyage->nb_place }}</p>
                                    <p class="text-3xl xl:text-2xl font-second">Prix par personne : {{ $voyage->prix_personne }}</p>
                                    <p class="text-3xl xl:text-2xl font-second">Voiture : {{ $voyage->voiture->marque->libelle ?? 'Aucune' }} {{ $voyage->voiture->modele }}</p>
                                    <p class="text-3xl xl:text-2xl font-second">Participants :
                                        @forelse($voyage->participantUsers as $participant)
                                            {{ $participant->pseudo }}@if(!$loop->last), @endif
                                        @empty
                                            Aucun
                                        @endforelse
                                    </p>
                                    <p class="text-3xl xl:text-2xl font-second">Statut : {{ $voyage->statut ?? 'Aucun' }}</p>
                                    <div class="flex flex-row justify-center items-center gap-2 mt-5 mb-1">
                                        <button type="button" onclick="annulerVoyage({{ $voyage->covoiturage_id }})"
                                        class="uppercase text-4xl xl:text-2xl font-second tracking-wide border-2 border-black bg-white rounded-3xl p-3 hover:bg-red-500">
                                            ANNULER
                                        </button>
                                        @if(in_array($voyage->statut, ['disponible', 'plein']))
                                            <button type="button" onclick="demarrerVoyage({{ $voyage->covoiturage_id }})"
                                            class="uppercase text-4xl xl:text-2xl tracking-wide text-center font-second border-2 border-black hover:bg-green2 bg-white rounded-3xl p-3">
                                                Démarrer
                                            </button>
                                        @elseif($voyage->statut === 'en cours')
                                            <button type="button" onclick="arreterVoyage({{ $voyage->covoiturage_id }})"
                                            class="uppercase text-4xl xl:text-2xl tracking-wide text-center font-second border-2 border-black hover:bg-green2 bg-white rounded-3xl p-3">
                                                Arrivée à destination
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @empty
                            <p class="text-center text-gray-600 font-second text-4xl xl:text-3xl">Aucun voyage trouvé.</p>
                        @endforelse
                    </div>
                </div>

                <form class="flex flex-col justify-center items-center gap-7 ml-5 mr-5" method="POST" action="{{ route('covoiturage.ajouter') }}">

                    @csrf

                    <div class="flex justify-center items-center gap-2">
                        <label for="date_depart" class="font-second text-3xl xl:text-2xl tracking-wide">Date de départ :</label>
                        <input type="date" id="date_depart" name="date_depart" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="heure_depart" class="font-second text-3xl xl:text-2xl tracking-wide">Heure de départ :</label>
                        <input type="time" id="heure_depart" name="heure_depart" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="lieu_depart" class="font-second text-3xl xl:text-2xl tracking-wide">Lieu de départ :</label>
                        <input type="text" id="lieu_depart" name="lieu_depart" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="date_arrivee" class="font-second text-3xl xl:text-2xl tracking-wide">Date d'arrivée :</label>
                        <input type="date" id="date_arrivee" name="date_arrivee" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="heure_arrivee" class="font-second text-3xl xl:text-2xl tracking-wide">Heure d'arrivée :</label>
                        <input type="time" id="heure_arrivee" name="heure_arrivee" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="lieu_arrivee" class="font-second text-3xl xl:text-2xl tracking-wide">Lieu d'arrivée :</label>
                        <input type="text" id="lieu_arrivee" name="lieu_arrivee" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>
                    
                    <div class="flex justify-center items-center gap-2">
                        <label for="nb_place" class="font-second text-3xl xl:text-2xl tracking-wide">Nombre de places :</label>
                        <input type="number" id="nb_place" name="nb_place" required max="7" min="1" placeholder="1" value="1"
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="prix_personne" class="font-second text-3xl xl:text-2xl tracking-wide">Prix par personne :</label>
                        <input type="number" id="prix_personne" name="prix_personne" required max="100" min="0"
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                        <div class="flex flex-col xl:flex-row justify-center items-center xl:gap-5">
                            <p class="flex flex-row font-second text-4xl xl:text-2xl gap-2">
                                Total : 
                                <span class="font-second text-4xl xl:text-2xl" id="prix_total"> - 2.00 </span>
                                <img class="mt-1" src="{{ asset('images/Credit.svg') }}" alt="Logo crédits">
                            </p>
                            <p class="flex font-second text-center text-3xl xl:text-xl">
                                (La plateforme prend 2 crédits de frais de service.)
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="select_voiture" class="font-second text-3xl xl:text-2xl">Voiture :</label>
                        <select type="text" id="select_voiture" name="select_voiture" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-black text-4xl xl:text-2xl placeholder-black p-1 items-center">
                            <option value="" disabled selected>Selectionnez une de vos voitures</option>
                            @foreach($voitures as $voiture)
                                <option class="text-black font-second text-4xl xl:text-2xl" value="{{ $voiture->voiture_id }}">{{$voiture->modele}} = {{$voiture->immatriculation}}</option> <!--The value is voiture_id the others are for display-->
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="text-4xl xl:text-3xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3 hover:bg-green2">AJOUTER UN VOYAGE</button>

                </form>

                <!--Message success ADD ride-->
                @if (session('successAddRide'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                title: 'Voyage ajouté !',
                                text: 'Votre voyage a été ajouté avec succès.',
                                icon: 'success',
                                showConfirmButton: true,
                                customClass:{
                                    popup: 'custom-swal'
                                }
                            });
                        })
                    </script>
                @endif

            </div>

            <div id="sectionVehicules" class="section flex-col justify-start w-200 xl:w-300 h-350 p-5 mt-5 mb-10 gap-4 bg-green4 rounded-3xl hidden">

                <div class="flex flex-col border-2 border-green1 w-full h-160 rounded-3xl p-2">
                    <p class="flex justify-center items-center font-second text-3xl">Mes véhicules</p>
                    <div id="vehiculeCards" class="flex mt-5 gap-5 overflow-x-auto"></div>
                </div>

                <form class="flex flex-col justify-center items-center gap-5 mt-10 ml-5 mr-5" method="POST" action="{{ route('vehicule.ajouter') }}">

                    @csrf

                    <div class="flex justify-center items-center gap-2">
                        <label for="marque" class="font-second text-3xl xl:text-2xl">MARQUE :</label>
                        <select type="text" id="marque" name="marque" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-black text-4xl xl:text-2xl placeholder-black p-1 items-center">
                            <option value="" disabled selected>Selectionnez une marque</option>
                            @foreach($marques as $marque)
                                <option value="{{ $marque->marque_id }}">{{ $marque->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="modele" class="font-second text-3xl xl:text-2xl">MODELE :</label>
                        <input type="text" id="modele" name="modele" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                    <label for="immatriculation" class="font-second text-3xl xl:text-2xl">IMMATRICULATION :</label>
                        <input type="text" id="immatriculation" name="immatriculation" required oninvalid="this.setCustomValidity('Format attendu : AB-123-CD')"
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center uppercase"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="datePremiereImmatriculation" class="font-second text-3xl xl:text-2xl">DATE DE LA PREMIERE IMMATRICULATION :</label>
                        <input type="date" id="datePremiereImmatriculation" name="datePremiereImmatriculation" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="couleur" class="font-second text-3xl xl:text-2xl">COULEUR :</label>
                        <input type="text" id="couleur" name="couleur" required
                        class="bg-white focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <div class="flex justify-center items-center gap-2">
                        <label for="energie" class="font-second text-3xl xl:text-2xl">ENERGIE ELECTRIQUE :</label>
                        <input type="checkbox" id="energie" name="energie"
                        class="text-green1 accent-green1 w-8 h-8 font-second text-4xl xl:text-2xl placeholder-black p-1 items-center"/>
                    </div>

                    <button type="submit" class="text-4xl xl:text-3xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3 hover:bg-green2">AJOUTER</button>

                </form>

                <div class="mt-5">

                    <!--Message error for car-->
                    @if ($errors->any())
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                Swal.fire({
                                    title: 'Erreur !',
                                    html: `
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="text-red-500 text-3xl font-second">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        `,
                                    icon: 'error',
                                    showConfirmButton: true,
                                    customClass:{
                                        popup: 'custom-swal'
                                    }
                                });
                            })
                        </script>
                    @endif

                    <!--Message success ADD car-->
                    @if (session('successAdd'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                Swal.fire({
                                    title: 'Véhicule ajouté !',
                                    text: 'Votre véhicule a été ajouté avec succès.',
                                    icon: 'success',
                                    showConfirmButton: true,
                                    customClass:{
                                        popup: 'custom-swal'
                                    }
                                });
                            })
                        </script>
                    @endif
                </div>
            
            </div>

        </div>

        <div id="sectionHistorique" class="flex flex-col justify-center items-center w-200 xl:w-300 p-5 mt-5 mb-10 gap-4 bg-green4 rounded-3xl">
            <p class="text-4xl xl:text-3xl font-second text-center mb-5">Historique</p>
            <div class="flex flex-row w-full gap-5 overflow-x-auto">
                @forelse($voyagesHistory as $voyage)
                    <div class="border-2 border-green1 rounded-3xl p-4 mb-4 flex-shrink-0">
                        <h3 class="text-4xl xl:text-3xl font-second text-green1 text-shadow-lg">De {{ $voyage->lieu_depart }} à {{ $voyage->lieu_arrivee }}</h3>
                        <p class="text-3xl xl:text-2xl font-second">Départ : {{ \Carbon\Carbon::parse($voyage->date_depart)->format('d/m/Y') }}</p>
                        <p class="text-3xl xl:text-2xl font-second">Statut : {{ ucfirst($voyage->statut) }}</p>
                        <p class="text-3xl xl:text-2xl font-second">Voiture : {{ $voyage->voiture->marque->libelle ?? 'Aucune' }} {{ $voyage->voiture->modele ?? 'Aucune' }}</p>
                        <p class="text-3xl xl:text-2xl font-second">Conducteur : {{ $voyage->utilisateur->pseudo ?? '' }}</p>
                        @if($voyage->statut === 'disponible')
                            <button type="button" onclick="window.location.href='{{ route('covoiturage.details', ['id' => $voyage->covoiturage_id]) }}'"
                                class="flex flex-row justify-center items-center gap-2 text-4xl xl:text-2xl font-second tracking-wide p-3 hover:text-green1 hover:underline hover:decoration-black active:text-black active:decoration-green1">
                                <img src="{{ asset('images/Details.svg') }}" alt="Logo nombre de passager" class="w-10 h-10">
                                <p class="text-3xl xl:text-2xl font-second">Détails</p>
                            </button>
                        @endif
                    </div>
                @empty
                    <p class="text-5xl xl:text-3xl font-second text-center text-gray-600">Aucun voyage trouvé.</p>
                @endforelse
            </div>
        </div>

    </div>

    @if(session('successAvis'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: @json(session('successAvis')),
                    icon: 'success',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @endif

    @if(session('errorAvis'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: @json(session('errorAvis')),
                    icon: 'error',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @endif

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

        const sections = document.getElementById("sections");

        const imgButton = document.createElement('img');

        imgButton.style.width = '100%';

        const sectionChauffeur = document.getElementById("sectionChauffeur");

        const userRoles = @json($roles);

        function updateDisplay(role) {
            chauffeurPassagerButton.setAttribute('data-role', role);
            chauffeurPassagerButton.textContent = '';
            if (role === 'chauffeur') {
                chauffeurPassagerButton.textContent = 'Chauffeur';
                imgButton.src = "{{ asset('images/Chauffeur.svg') }}";
                imgButton.alt = 'Logo chauffeur';
                chauffeurPassagerButton.appendChild(imgButton);
                sectionChauffeur.classList.remove('hidden');
                sectionChauffeur.classList.add('flex');
                sections.classList.remove('hidden');
                sections.classList.add('flex');
            } else {
                chauffeurPassagerButton.textContent = 'Passager';
                imgButton.src = "{{ asset('images/Passager.svg') }}";
                imgButton.alt = 'Logo passager';
                chauffeurPassagerButton.appendChild(imgButton);
                sectionChauffeur.classList.add('hidden');
                sectionChauffeur.classList.remove('flex');
                sections.classList.add('hidden');
                sections.classList.remove('flex');
            }
        }

        let currentRole = userRoles.length > 0 ? userRoles[0] : 'passager';
        updateDisplay(currentRole);

        chauffeurPassagerButton.addEventListener('click', function() {
            let newRole = currentRole === 'passager' ? 'chauffeur' : 'passager';

            fetch('/user/role', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                credentials: 'same-origin',
                body: JSON.stringify({ roles: [newRole] })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentRole = newRole;
                    updateDisplay(currentRole);
                } else {
                    alert('Erreur lors de la mise à jour du rôle.');
                }
            })
            .catch(e => alert('Erreur réseau : ' + e.message));
        });

        //Show/Hide sections
        function ShowSection(id){
            const allSections = document.querySelectorAll('.section');
            
            allSections.forEach(section => {
                if (section.id === id){
                    section.classList.remove('hidden');
                    section.classList.add('flex');
                }
                else if (!section.classList.contains('hidden')){
                    section.classList.add('hidden');
                    section.classList.remove('flex');              
                }
            })

            const buttons = sectionChauffeur.querySelectorAll('button');

            buttons.forEach(button => {
                if (button.id === id){
                    button.classList.add('underline', 'decoration-green1', 'decoration-6', 'xl:decoration-4');
                }
                else{
                    button.classList.remove('underline', 'decoration-green1', 'decoration-6', 'xl:decoration-4');
                }
            });
        };

        //Limit photo
        document.getElementById('photo').addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                var maxSize = 2 * 1024 * 1024; // Limite de 2 Mo (en octets)
                if (file.size > maxSize) {
                    Swal.fire({
                        title: 'Erreur !',
                        text: 'Le fichier est trop volumineux, la taille maximale autorisée est de 2 Mo.',
                        icon: 'error',
                        showConfirmButton: true,
                        customClass:{
                            popup: 'custom-swal'
                        }
                    });
                    this.value = '';
                }
            }
        });

        //Show car card
        function afficherVehicules() {
            fetch('/api/vehicules')
            .then(res => res.json())
            .then(vehicules => {
            const container = document.getElementById('vehiculeCards');
            container.innerHTML = ''; //Clean

            vehicules.forEach(vehicule => {

                const card = document.createElement('div');
                card.className = "border-2 border-green1 shadow-md rounded-3xl p-4 w-100 h-205 flex-shrink-0";
                    card.innerHTML = `
                    <h2 class="flex justify-center text-4xl xl:text-3xl font-second mb-2">${vehicule.modele}</h2>
                    <p class="text-3xl font-second">Marque :<br><p class="text-4xl xl:text-2xl font-second tracking-wide">${vehicule.marque.libelle}</p></p>
                    <p class="text-3xl font-second">Immatriculation :<br><p class="text-4xl xl:text-2xl font-second tracking-wide">${vehicule.immatriculation}</p></p>
                    <p class="text-3xl font-second">Couleur :<br><p class="text-4xl xl:text-2xl font-second tracking-wide">${vehicule.couleur}</p></p>
                    <p class="text-3xl font-second">Énergie électrique :<br><p class="text-4xl xl:text-2xl font-second tracking-wide">${vehicule.energie}</p></p>
                    <p class="text-3xl font-second">Date 1ère immatriculation :<br><p class="text-4xl xl:text-2xl font-second tracking-wide">${vehicule.date_premiere_immatriculation}</p></p>
                    <button type="button" onclick="supprimerVehicule(${vehicule.voiture_id})" 
                    class="hover:bg-green2 active:bg-green1 block mx-auto mt-5 text-4xl xl:text-3xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3">
                    SUPPRIMER
                    </button>
                `;
                container.appendChild(card);
            });
        });
        }

        //Delete car
        function supprimerVehicule(voiture_id){
            Swal.fire({
                title: 'Supprimer ce véhicule ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Supprimer',
                cancelButtonText: 'Annuler',
                customClass: {
                    popup: 'custom-swal'
                }
            }).then((result) => {
                if(result.isConfirmed){
                    fetch(`/voiture/${voiture_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept' : 'application/json'
                        }
                    })

                    .then(res => {
                        if(res.ok){
                            Swal.fire({
                                title: 'Véhicule supprimé!',
                                text: 'Votre véhicule a été supprimé avec succès.',
                                icon: 'success',
                                showConfirmButton: true,
                                customClass:{
                                    popup: 'custom-swal'
                                }
                            }).then(() => {
                                location.reload();
                            });

                        } else {
                            Swal.fire({
                                title: 'Erreur !',
                                text: 'Erreur lors de la suppression',
                                icon: 'error',
                                showConfirmButton: true,
                                customClass:{
                                    popup: 'custom-swal'
                                }
                            });
                        }
                    })

                    .catch(error => 
                        Swal.fire({
                            title: 'Erreur !',
                            text: 'Erreur lors de la suppression',
                            icon: 'error',
                            showConfirmButton: true,
                            customClass:{
                                popup: 'custom-swal'
                            }
                        })
                    );
                }
            })
        }

        //Update price on Take a Ride
        const prixPersonne = document.getElementById("prix_personne");
        const prixTotal = document.getElementById("prix_total");
        const nbPlace = document.getElementById("nb_place");

        function updatePrice(){
            const prix = parseInt(prixPersonne.value) || 0;
            const places = parseInt(nbPlace.value) || 0;

            const total = (prix * places - 2);
            prixTotal.textContent = total.toFixed(2);
        }

        prixPersonne.addEventListener('input', updatePrice);
        nbPlace.addEventListener('input', updatePrice);


        //Cancel ride
        function annulerVoyage(id){
            Swal.fire({
                title: 'Annuler ce voyage ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Annuler le voyage',
                cancelButtonText: 'Retour',
                customClass: {
                    popup: 'custom-swal'
                }
            }).then((result) => {
                if(result.isConfirmed){
                    fetch(`/voyage/${id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept' : 'application/json'
                        }
                    })

                    .then(res => {
                        if(res.ok){
                            Swal.fire({
                                title: 'Voyage annulé !',
                                icon: 'success',
                                showConfirmButton: true,
                                customClass:{
                                    popup: 'custom-swal'
                                }
                            }).then(() => {
                                location.reload();
                            });

                        } else {
                                Swal.fire({
                                    title: 'Erreur !',
                                    text: 'Erreur lors de la suppression',
                                    icon: 'error',
                                    showConfirmButton: true,
                                    customClass: {
                                        popup: 'custom-swal'
                                    }
                                });
                        }
                    })

                    .catch(error => 
                        Swal.fire({
                            title: 'Erreur !',
                            text: 'Erreur lors de la suppression',
                            icon: 'error',
                            showConfirmButton: true,
                            customClass:{
                                popup: 'custom-swal'
                            }
                        })
                    );
                }
            })
        }

        //Start a ride
        function demarrerVoyage(id){
            Swal.fire({
                title: 'Démarrer ce voyage ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Démarrer le voyage',
                cancelButtonText: 'Retour',
                customClass: {
                    popup: 'custom-swal'
                }
            }).then((result) => {
                if(result.isConfirmed){
                    fetch(`/voyage/${id}/demarrer`, {
                        method: 'POST',
                        headers: {
                            'Content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept' : 'application/json'
                        }
                    })

                    .then(res => {
                        if(res.ok){
                            Swal.fire({
                                title: 'Voyage démarré, bonne route !',
                                icon: 'success',
                                showConfirmButton: true,
                                customClass:{
                                    popup: 'custom-swal'
                                }
                            }).then(() => {
                                location.reload();
                            });

                        } else {
                                Swal.fire({
                                    title: 'Erreur !',
                                    text: 'Erreur lors du démarrage',
                                    icon: 'error',
                                    showConfirmButton: true,
                                    customClass: {
                                        popup: 'custom-swal'
                                    }
                                });
                        }
                    })

                    .catch(error => 
                        Swal.fire({
                            title: 'Erreur !',
                            text: 'Erreur lors du démarrage',
                            icon: 'error',
                            showConfirmButton: true,
                            customClass:{
                                popup: 'custom-swal'
                            }
                        })
                    );
                }
            })
        }

        //Stop a ride
        function arreterVoyage(id){
            Swal.fire({
                title: 'Arrêter ce voyage ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Arrêter le voyage',
                cancelButtonText: 'Retour',
                customClass: {
                    popup: 'custom-swal'
                }
            }).then((result) => {
                if(result.isConfirmed){
                    fetch(`/voyage/${id}/arreter`, {
                        method: 'POST',
                        headers: {
                            'Content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept' : 'application/json'
                        }
                    })

                    .then(res => {
                        if(res.ok){
                            Swal.fire({
                                title: 'Voyage terminé !',
                                icon: 'success',
                                showConfirmButton: true,
                                customClass:{
                                    popup: 'custom-swal'
                                }
                            }).then(() => {
                                location.reload();
                            });

                        } else {
                                Swal.fire({
                                    title: 'Erreur !',
                                    text: 'Erreur lors de l\'arrêt du voyage.',
                                    icon: 'error',
                                    showConfirmButton: true,
                                    customClass: {
                                        popup: 'custom-swal'
                                    }
                                });
                        }
                    })

                    .catch(error => 
                        Swal.fire({
                            title: 'Erreur !',
                            text: 'Erreur lors de l\'arrêt du voyage.',
                            icon: 'error',
                            showConfirmButton: true,
                            customClass:{
                                popup: 'custom-swal'
                            }
                        })
                    );
                }
            })
        }
    </script>

@endsection