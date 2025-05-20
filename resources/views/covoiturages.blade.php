@extends('layouts.app')

@section('content')

    @php
        $today = now()->startOfDay()->format('Y-m-d');
    @endphp

    <div class="flex flex-col items-center justify-center mt-75 xl:mt-5">

        <form method="get" action="{{ route('covoiturage.rechercher') }}">

            @csrf

            <div class="flex 3xl:flex-row flex-col justify-center items-center gap-5 3xl:gap-5">
                <div class="flex flex-row justify-center items-center gap-10">
                    <div class="relative">
                        <img src="{{ asset('Images/Depart.svg') }}" alt="Logo Départ" class="absolute left-5 top-1/2 transform -translate-y-1/2 w-15 h-15">
                        <input type="text" id="lieu_depart" name="lieu_depart" required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase text-center placeholder-gray-500"
                        placeholder="Départ" value="{{ old('lieu_depart', $lieu_depart ?? '') }}"/>
                    </div>

                    <div class="relative">
                        <img src="{{ asset('Images/Arrivee.svg') }}" alt="Logo Arrivée" class="absolute left-5 top-1/2 transform -translate-y-1/2 w-15 h-15">
                        <input type="text" id="lieu_arrivee" name="lieu_arrivee" required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl not-visited:uppercase text-center placeholder-gray-500"
                        placeholder="Arrivée" value="{{ old('lieu_arrivee', $lieu_arrivee ?? '') }}"/>
                    </div>
                </div>

                <div class="flex flex-row justify-center items-center gap-10">
                    <div class="relative">
                        <img src="{{ asset('Images/Date.svg') }}" alt="Logo Date" class="absolute left-5 top-1/2 transform -translate-y-1/2 w-15 h-15">
                        <input type="date" id="date_depart" name="date_depart" required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase text-center flex justify-center placeholder-gray-500"
                        placeholder="{{ $today }}"
                        value="{{ old('date_depart', $date_depart ?? $today) }}"/>
                    </div>

                    <div class="relative">
                        <img src="{{ asset('Images/NombreDePassager.svg') }}" alt="Logo passager" class="absolute left-5 top-1/2 transform -translate-y-1/2 w-15 h-15">
                        <input type="integer" id="nb_place" name="nb_place" required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase text-center placeholder-black"
                        placeholder="1" value="{{ old('nb_place', $nb_place ?? 1) }}" min="1" max="7"/>
                    </div>
                </div>

                <button type="submit" class="relative 3xl:hidden block text-4xl xl:text-2xl font-second tracking-wide border-2 border-green1 bg-green4 rounded-3xl w-sm p-3 pl-10 pr-10 hover:border-black active:border-green1">
                <img src="{{ asset('Images/Recherche.svg') }}" alt="Logo recherche" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                CHERCHER
                </button>

                @if($utilisateur)
                    <div class="flex flex-row items-center justify-center gap-2 w-80">
                        <p class="text-4xl xl:text-2xl font-second text-black">Vous avez : {{$utilisateur->credits}}</p>
                        <img src="{{ asset('Images/Credit.svg') }}" alt="Logo crédit" class="w-10 h-10">
                    </div>
                @endif
                
            </div>

            <div class="hidden 3xl:flex justify-center items-center mt-5">
                <button type="submit" class="relative text-4xl xl:text-3xl font-second tracking-wide border-2 border-green1 bg-green4 rounded-3xl w-xs p-3 pl-10 pr-10 hover:border-black active:border-green1">
                <img src="{{ asset('Images/Recherche.svg') }}" alt="Logo recherche" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                CHERCHER
                </button>
            </div>



            <!-- FILTERS -->
            <div class="flex flex-col gap-5 justify-center items-center mt-5 mb-5">

                <div class="flex flex-row gap-5 justify-center items-center">

                    <input type="hidden" id="ecologique_filtre" name="ecologique_filtre" value="{{ old('ecologique_filtre', $ecologique_filtre ?? 'Non') }}">
                    <button type="button" name="filtre_ecologique" value="filtre_ecologique" onclick="ecologiqueFiltre()"
                    class="border-2 border-green1 rounded-3xl w-55 font-second text-4xl xl:text-2xl uppercase text-center flex justify-center items-center flex-col gap-2 p-3">
                        <p class="text-4xl xl:text-2xl font-second text-black text-center">
                            ecologique
                        </p>
                        <div class="flex flex-row justify-center items-center gap-2">
                            <p class="text-4xl xl:text-2xl font-second" id="ecologique_non">NON</p>
                            <img src="{{ asset('Images/Ecologique.svg') }}" alt="Logo energie électrique" class="w-10 h-10">
                            <p class="text-4xl xl:text-2xl font-second text-gray-500" id="ecologique_oui">OUI</p>
                        </div>
                    </button>

                    <div class="border-2 border-green1 rounded-3xl w-55 font-second text-4xl uppercase text-center flex justify-center items-center flex-col gap-2 p-3">
                        <p class="text-4xl xl:text-2xl font-second uppercase text-center">
                            Prix max
                        </p>
                        <div class="flex flex-row justify-center items-center gap-2">
                            <input type="integer" id="prix_max" name="prix_max"
                            class="bg-gray-300 font-second text-4xl xl:text-2xl uppercase text-center w-10"
                            value="{{ old('prix_max', $prix_max ?? 100) }}" min="0" max="100"/>
                            <img src="{{ asset('Images/Credit.svg') }}" alt="Logo crédits" class="w-10 h-10">
                        </div>
                    </div>

                </div>

                <div class="flex flex-row gap-5 justify-center items-center">
                    <div class="border-2 border-green1 rounded-3xl w-55 font-second text-4xl uppercase text-center flex justify-center items-center flex-col gap-2 p-3">
                        <p class="text-4xl xl:text-2xl font-second uppercase text-center">
                            Durée max
                        </p>
                        <div class="flex flex-row justify-center items-center gap-2">
                            <input type="time" id="duree_max" name="duree_max"
                            class="bg-gray-300 font-second text-4xl xl:text-2xl uppercase text-center w-30"
                            min="00:00" max="23:59" value="{{ old('duree_max', $duree_max ?? '23:59') }}"/>
                            <img src="{{ asset('Images/Duree.svg') }}" alt="Logo crédits" class="w-10 h-10">
                        </div>
                    </div>

                    <div class="border-2 border-green1 rounded-3xl w-55 font-second text-4xl xl:text-2xl uppercase text-center flex justify-center items-center flex-col gap-2 p-3">
                        <p class="text-4xl xl:text-2xl font-second uppercase text-center">
                            Note minimale
                        </p>
                        <div class="flex flex-row justify-center items-center gap-2">
                            <input type="number" id="note_minimale" name="note_minimale"
                            class="bg-gray-300 font-second text-4xl xl:text-2xl uppercase text-center w-10"
                            min="0" max="5" value="{{ old('note_minimale', $note_minimale ?? 1) }}"/>
                            <p class="text-4xl xl:text-2xl font-second uppercase text-center">
                                / 5
                            </p>
                            <img src="{{ asset('Images/Note.svg') }}" alt="Logo crédits" class="w-10 h-10">
                        </div>
                    </div>

                </div>

            </div>

        </form>

        @if (isset($recherche)&&$recherche)
            @if ($covoiturages->isEmpty())
                <p class="text-5xl xl:text-3xl font-second text-gray-600 m-10 text-center">PAS DE TRAJETS</p>
            @else
                <ul>   
                    @foreach ($covoiturages as $covoiturage)
                        <li class="flex flex-row rounded-3xl items-center justify-center mt-5 mb-5 w-200 h-100">
                            <div class="flex flex-col items-center justify-center gap-5 p-10 h-full w-2/6 border rounded-l-3xl border-r-0 border-black">
                                @if($covoiturage->utilisateur->photo)
                                    <img src="{{ asset('storage/' .$covoiturage->utilisateur->photo) }}" alt="Photo utilisateur" class="w-40 h-40 rounded-full object-cover m-2">
                                @else
                                    <img src="{{ asset('Images/PhotoDeProfilDefaut.png') }}" alt="Photo utilisateur par défaut" class="w-40 h-40 rounded-full object-cover m-2">
                                @endif
                                <p class="text-4xl xl:text-2xl font-second text-center text-black">{{ $covoiturage->utilisateur->pseudo }}</p>
                                <p class="text-4xl xl:text-2xl font-second text-center text-black flex flex-row justify-center items-center gap-2">
                                    {{$covoiturage->utilisateur->note}} 
                                    <img src="{{ asset('images/Note.svg') }}" alt="Logo Note" class="w-10 h-10">
                                </p>
                            </div>
                            <div class="bg-white border border-black rounded-r-3xl w-4/6 h-full flex flex-col gap-5">
                                <div class="border-b border-black w-full h-1/2 flex flex-row gap-3">
                                    <div class="flex flex-row items-center justify-center w-full h-full gap-2 font-second text-5xl xl:text-2xl text-black">
                                        {{ $covoiturage->nb_place }}
                                        <img src="{{ asset('Images/NombreDePassager.svg') }}" alt="Logo nombre de passager" class="w-10 h-10">
                                    </div>
                                    <div class="flex flex-row items-center justify-center w-full h-full gap-2 font-second text-5xl xl:text-2xl text-black">
                                        {{ $covoiturage->prix_personne }}
                                        <img src="{{ asset('Images/Credit.svg') }}" alt="Logo nombre de passager" class="w-10 h-10">
                                    </div>
                                    @if($covoiturage->voiture->energie === 'Oui')
                                        <div class="flex items-center justify-center w-full h-full gap-1">
                                        <img src="{{ asset('Images/Ecologique.svg') }}" alt="Logo energie électrique" class="w-10 h-10">
                                        </div>
                                    @endif
                                    <button type="button" onclick="window.location.href='{{ route('covoiturage.details', ['id' => $covoiturage->covoiturage_id]) }}'"
                                    class="flex flex-col items-center justify-center w-full h-full gap-1 font-second text-5xl xl:text-2xl text-black hover:text-green1 active:text-black">
                                        <img src="{{ asset('Images/Details.svg') }}" alt="Logo nombre de passager" class="w-10 h-10">
                                        Détails
                                    </button>
                                </div>
                                <div class="w-full h-1/2 flex flex-col justify-center items-center gap-5">
                                    <div class="w-full flex flex-row justify-center items-center gap-5">
                                        <img src="{{ asset('Images/Date.svg') }}" alt="Logo nombre de passager" class="w-10 h-10">
                                        <p class="font-second text-5xl xl:text-2xl text-black">
                                            {{ \Carbon\Carbon::parse($covoiturage->date_depart)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row justify-center gap-5 p-5">
                                        <div class="flex flex-row  items-center justify-center gap-2">
                                            <img src="{{ asset('Images/Depart.svg') }}" alt="Logo de la date de départ" class="w-10 h-10">
                                            <p class="font-second text-5xl xl:text-2xl text-black">
                                                {{ \Carbon\Carbon::parse($covoiturage->heure_depart)->format('H:i') }} de {{ $covoiturage->lieu_depart }}
                                            </p>
                                        </div>
                                        <div class="flex flex-row items-center justify-center gap-2">
                                            <img src="{{ asset('Images/Arrivee.svg') }}" alt="Logo de la date d'arrivée" class="w-10 h-10">
                                            <p class="font-second text-5xl xl:text-2xl text-black">
                                                {{ \Carbon\Carbon::parse($covoiturage->heure_arrivee)->format('H:i') }} à {{ $covoiturage->lieu_arrivee }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endif
    </div>

    <script>
        //ecological filter display
        var ecologique_filtre = document.getElementById("ecologique_filtre");
        var non = document.getElementById("ecologique_non");
        var oui = document.getElementById("ecologique_oui");

        if (ecologique_filtre.value === "Non") {
            non.classList.remove("text-gray-500");
            non.classList.add("text-black");
            oui.classList.remove("text-black");
            oui.classList.add("text-gray-500");
        } else {
            non.classList.remove("text-black");
            non.classList.add("text-gray-500");
            oui.classList.remove("text-gray-500");
            oui.classList.add("text-black");
        }

        function ecologiqueFiltre() {

            if (ecologique_filtre.value === "Non") {
                non.classList.remove("text-black");
                non.classList.add("text-gray-500");
                oui.classList.remove("text-gray-500");
                oui.classList.add("text-black");
                ecologique_filtre.value = "Oui";
            } else {
                non.classList.remove("text-gray-500");
                non.classList.add("text-black");
                oui.classList.remove("text-black");
                oui.classList.add("text-gray-500");
                ecologique_filtre.value = "Non";
            }
        }

    </script>

@endsection