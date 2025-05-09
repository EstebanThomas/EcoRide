@extends('layouts.app')

@section('content')

    @php
        $today = now()->format('Y-m-d');
    @endphp

    <div class="flex flex-col items-center justify-center mt-75 xl:mt-5">

        <form method="POST" action="{{ route('covoiturage.rechercher') }}">

            @csrf

            <div class="flex 3xl:flex-row flex-col justify-center items-center gap-5 3xl:gap-5">
                <div class="flex flex-row justify-center items-center gap-10">
                    <div class="relative">
                        <img src="{{ asset('images/Depart.svg') }}" alt="Logo Départ" class="absolute left-5 top-1/2 transform -translate-y-1/2 w-15 h-15">
                        <input type="text" id="lieu_depart" name="lieu_depart" required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-gray-500"
                        placeholder="Départ"/>
                    </div>

                    <div class="relative">
                        <img src="{{ asset('images/Arrivee.svg') }}" alt="Logo Arrivée" class="absolute left-5 top-1/2 transform -translate-y-1/2 w-15 h-15">
                        <input type="text" id="lieu_arrivee" name="lieu_arrivee" required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-gray-500"
                        placeholder="Arrivée"/>
                    </div>
                </div>

                <div class="flex flex-row justify-center items-center gap-10">
                    <div class="relative">
                        <img src="{{ asset('images/Date.svg') }}" alt="Logo Date" class="absolute left-5 top-1/2 transform -translate-y-1/2 w-15 h-15">
                        <input type="date" id="date_depart" name="date_depart" required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center flex justify-center placeholder-gray-500"
                        placeholder="{{$today}}"
                        value="{{$today}}"/>
                    </div>

                    <div class="relative">
                        <img src="{{ asset('images/NombreDePassager.svg') }}" alt="Logo passager" class="absolute left-5 top-1/2 transform -translate-y-1/2 w-15 h-15">
                        <input type="integer" id="nb_place" name="nb_place" required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                        placeholder="1" value="1" min="1" max="7"/>
                    </div>
                </div>

                <button type="submit" class="relative 3xl:hidden block text-4xl font-second tracking-wide border-2 border-green1 bg-green4 rounded-3xl w-sm p-3 pl-10 pr-10 hover:border-black">
                <img src="{{ asset('images/Recherche.svg') }}" alt="Logo recherche" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                CHERCHER
                </button>
                
            </div>

            <div class="hidden 3xl:flex justify-center items-center mt-5">
                <button type="submit" class="relative text-4xl font-second tracking-wide border-2 border-green1 bg-green4 rounded-3xl w-xs p-3 pl-10 pr-10 hover:bg-green2">
                <img src="{{ asset('images/Recherche.svg') }}" alt="Logo recherche" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                CHERCHER
                </button>
            </div>

        </form>

        <!--Filters-->
        <form method="GET" action="{{route('covoiturage.rechercher')}}" class="mt-5 flex flex-row justify-center items-center gap-5">
            <input type="hidden" id="ecologique_filtre" name="ecologique_filtre" value="Non">
            <button type="button" name="filtre_ecologique" value="filtre_ecologique" onclick="ecologiqueFiltre()"
            class="border-2 border-green1 rounded-3xl w-xs font-second text-4xl uppercase text-center flex justify-center items-center flex-col gap-2 p-3">
                <p class="text-4xl font-second text-black text-center">
                    ecologique
                </p>
                <div class="flex flex-row justify-center items-center gap-2">
                    <p class="text-4xl font-second" id="ecologique_non">NON</p>
                    <img src="{{ asset('images/Ecologique.svg') }}" alt="Logo energie électrique" class="w-10 h-10">
                    <p class="text-4xl font-second text-gray-500" id="ecologique_oui">OUI</p>
                </div>
            </button>
            <div class="border-2 border-green1 rounded-3xl w-xs font-second text-4xl uppercase text-center flex justify-center items-center flex-col gap-2 p-3">
                <p class="text-4xl font-second uppercase text-center">
                    Prix max
                </p>
                <div class="flex flex-row justify-center items-center gap-2">
                    <input type="integer" id="prix_max" name="prix_max"
                    class="bg-gray-300 font-second text-4xl uppercase text-center w-10"
                    value="100" min="0" max="100"/>
                    <img src="{{ asset('images/Credit.svg') }}" alt="Logo crédits" class="w-10 h-10">
                </div>
            </div>

        </form>

        @if ($covoiturages->isEmpty())
            <p>PAS DE TRAJETS</p>
        @else
            <ul>   
                @foreach ($covoiturages as $covoiturage)
                    <li class="flex flex-row rounded-3xl items-center justify-center mt-5 mb-5 w-200 h-100">
                        <div class="flex flex-col items-center justify-center gap-5 p-10 h-full w-2/6 border rounded-l-3xl border-r-0 border-black">
                            @if($covoiturage->utilisateur->photo)
                                <img src="{{ asset('storage/' .$covoiturage->utilisateur->photo) }}" alt="Photo utilisateur" class="w-40 h-40 rounded-full object-cover m-2">
                            @else
                                <img src="{{ asset('images/PhotoDeProfilDefaut.png') }}" alt="Photo utilisateur par défaut" class="w-40 h-40 rounded-full object-cover m-2">
                            @endif
                            <p class="text-4xl font-second text-center text-black">{{ $covoiturage->utilisateur->pseudo }}</p>
                        </div>
                        <div class="bg-white border border-black rounded-r-3xl w-4/6 h-full flex flex-col gap-5">
                            <div class="border-b border-black w-full h-1/2 flex flex-row gap-3">
                                <div class="flex flex-row items-center justify-center w-full h-full gap-2 font-second text-5xl text-black">
                                    {{ $covoiturage->nb_place }}
                                    <img src="{{ asset('images/NombreDePassager.svg') }}" alt="Logo nombre de passager" class="w-10 h-10">
                                </div>
                                <div class="flex flex-row items-center justify-center w-full h-full gap-2 font-second text-5xl text-black">
                                    {{ $covoiturage->prix_personne }}
                                    <img src="{{ asset('images/Credit.svg') }}" alt="Logo nombre de passager" class="w-10 h-10">
                                </div>
                                @if($covoiturage->voiture->energie === 'Oui')
                                    <div class="flex items-center justify-center w-full h-full gap-1">
                                    <img src="{{ asset('images/Ecologique.svg') }}" alt="Logo energie électrique" class="w-10 h-10">
                                    </div>
                                @endif
                                <button type="button" onclick="window.location.href='{{ route('covoiturage.details', ['id' => $covoiturage->covoiturage_id]) }}'"
                                class="flex flex-col items-center justify-center w-full h-full gap-1 font-second text-5xl text-black hover:text-green1 active:text-black">
                                    <img src="{{ asset('images/Details.svg') }}" alt="Logo nombre de passager" class="w-10 h-10">
                                    Détails
                                </button>
                            </div>
                            <div class="w-full h-1/2 flex flex-col justify-center items-center gap-10">
                                <div class="w-full flex flex-row justify-center items-center gap-5">
                                    <img src="{{ asset('images/Date.svg') }}" alt="Logo nombre de passager" class="w-10 h-10">
                                    <p class="font-second text-5xl text-black">
                                        {{ \Carbon\Carbon::parse($covoiturage->date_depart)->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div class="flex flex-row justify-center gap-15">
                                    <div class="flex flex-row  items-center justify-center gap-2">
                                        <img src="{{ asset('images/Depart.svg') }}" alt="Logo de la date de départ" class="w-10 h-10">
                                        <p class="font-second text-5xl text-black">
                                            {{ \Carbon\Carbon::parse($covoiturage->heure_depart)->format('H:i') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-row items-center justify-center gap-2">
                                        <img src="{{ asset('images/Arrivee.svg') }}" alt="Logo de la date d'arrivée" class="w-10 h-10">
                                        <p class="font-second text-5xl text-black">
                                            {{ \Carbon\Carbon::parse($covoiturage->heure_arrivee)->format('H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <script>
        //filers display
        function ecologiqueFiltre() {
            var non = document.getElementById("ecologique_non");
            var oui = document.getElementById("ecologique_oui");
            const hiddenInputEcologique = document.getElementById("ecologique_filtre");

            if (non.classList.contains("text-black")) {
                non.classList.remove("text-black");
                non.classList.add("text-gray-500");
                oui.classList.remove("text-gray-500");
                oui.classList.add("text-black");
                hiddenInputEcologique.value = "Oui";
            } else {
                non.classList.remove("text-gray-500");
                non.classList.add("text-black");
                oui.classList.remove("text-black");
                oui.classList.add("text-gray-500");
                hiddenInputEcologique.value = "Non";
            }
        }

    </script>

@endsection