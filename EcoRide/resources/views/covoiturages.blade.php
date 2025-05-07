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
                        placeholder="1" value="1"/>
                    </div>
                </div>

                <button type="submit" class="3xl:hidden block text-4xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3 pl-10 pr-10 hover:bg-green2">
                CHERCHER
                </button>
                
            </div>

            <div class="hidden 3xl:flex justify-center items-center mt-5">
                <button type="submit" class="text-4xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3 pl-10 pr-10 hover:bg-green2">
                CHERCHER
                </button>
            </div>

        </form>

        @if ($covoiturages->isEmpty())
            <p>PAS DE TRAJETS</p>
        @else
            <ul>   
                @foreach ($covoiturages as $covoiturage)
                    <li class="flex flex-col items-center justify-center mt-5">
                        <div class="bg-green1 rounded-3xl p-5 w-3/4 flex flex-col items-center justify-center gap-5">
                            <h2 class="text-4xl font-second text-center text-black">Covoiturage de {{ $covoiturage->lieu_depart }} à {{ $covoiturage->lieu_arrivee }}</h2>
                            <p class="text-2xl font-second text-center text-black">Date de départ : {{ $covoiturage->date_depart }}</p>
                            <p class="text-2xl font-second text-center text-black">Nombre de places disponibles : {{ $covoiturage->nb_place }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

@endsection