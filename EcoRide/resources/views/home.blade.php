
@extends('layouts.app')

@section('content')

    <!--Form search route-->
    <div class="mt-75 xl:mt-0">

        <form action="/Recherche-covoiturage" method="GET" class="flex flex-col mt-8">

            <div class="flex flex-row w-full justify-center gap-4">
                <div class="relative">
                    <!--<label for="depart">Départ</label>-->
                    <input
                        type="text"
                        id="depart"
                        name="depart"
                        placeholder="Départ"
                        required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                    />
                    <img src="{{ asset('images/Depart.svg') }}" alt="Logo Depart" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
                
                <div class="relative">
                    <!--<label for="destination">Destination</label>-->
                    <input
                        type="text"
                        id="destination"
                        name="destination"
                        placeholder="Destination"
                        required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                    />
                    <img src="{{ asset('images/Arrivee.svg') }}" alt="Logo Destination" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
            </div>

            <div class="flex flex-row w-full justify-center gap-4">
                <div class="relative mt-4">
                    <!--<label for="date">Date</label>-->
                    <input
                        type="text"
                        id="date"
                        name="date"
                        placeholder="Date"
                        required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                    />
                    <img src="{{ asset('images/Date.svg') }}" alt="Logo Date" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>

                <div class="relative mt-4">
                    <!--<label for="passager">Passager</label>-->
                    <input
                        type="text"
                        id="passager"
                        name="passager"
                        placeholder="Passager"
                        required
                        class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                    />
                    <img src="{{ asset('images/NombreDePassager.svg') }}" alt="Logo nombre de passager" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
            </div>

            <div class="flex justify-center mt-4">
                <button
                class="relative bg-green4 border-2 border-green1 rounded-3xl w-sm h-18 font-second text-4xl uppercase text-center" type="submit">
                <img src="{{ asset('images/Recherche.svg') }}" alt="Logo recherche" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                Chercher
                </button>
            </div>

        </form>

    </div>

    <!--informations-->
    <div class="flex flex-col m-10 xl:mr-50 xl:ml-50">

        <div class="flex justify-evenly items-center">
            <p class="block xl:hidden font-second text-6xl text-green1 text-center">
                Le covoiturage<br> respecteux<br>de l’environnement.
            </p>
            <p class="hidden xl:block font-second text-6xl text-green1 text-center">
                Le covoiturage respecteux<br>de l’environnement.
            </p>
            <div class="w-100 h-75 xl:h-50 rounded-3xl overflow-hidden">
                <img src="{{ asset('images/VoitureHerbe.jpg') }}" alt="Photo d'un van dans l'herbe" class="max-w-108 xl:max-w-98">
            </div>
        </div>

        <div class="flex justify-evenly mt-5 xl:mt-1 items-center">
            <div class="w-100 h-75 xl:h-50 rounded-3xl overflow-hidden">
                <img src="{{ asset('images/VoitureElectrique.jpg') }}" alt="Photo d'une voiture électrique" class="max-w-108 xl:max-w-98">
            </div>
            <p class="block xl:hidden font-second text-5xl text-green1 text-center m-2">
                EcoRide s’engage<br>pour l’environnement<br>grâce à son système<br>de covoiturage avec<br>l’option «voyage écologique».
            </p>
            <p class="hidden xl:block font-second text-4xl text-green1 text-center m-2">
                EcoRide s’engage pour l’environnement<br>grâce à son système de covoiturage<br>avec l’option «voyage écologique».
            </p>
        </div>
    </div>

@endsection