
@extends('layouts.app')

@section('content')

    <!--Form search route-->
    <div>

        <form action="/Recherche-covoiturage" method="GET" class="flex flex-col">

            <div class="flex flex-row w-full justify-evenly">
                <div class="relative top-[165px]">
                    <!--<label for="depart">Départ</label>-->
                    <input
                        type="text"
                        id="depart"
                        name="depart"
                        placeholder="Départ"
                        required
                        class="bg-green4 border-2 border-green1 rounded-[20px] pl-8 pr-2 w-[140px] h-[33px] focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-[20px] uppercase text-center"
                    />
                    <img src="{{ asset('images/Depart.svg') }}" alt="Logo Depart" class="absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
                
                <div class="relative top-[165px]">
                    <!--<label for="destination">Destination</label>-->
                    <input
                        type="text"
                        id="destination"
                        name="destination"
                        placeholder="Destination"
                        required
                        class="bg-green4 border-2 border-green1 rounded-[20px] pl-8 pr-2 w-[140px] h-[33px] focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-[20px] uppercase text-center"
                    />
                    <img src="{{ asset('images/Arrivee.svg') }}" alt="Logo Destination" class="absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
            </div>

            <div class="flex flex-row w-full justify-evenly">
                <div class="relative top-[174px]">
                    <!--<label for="date">Date</label>-->
                    <input
                        type="text"
                        id="date"
                        name="date"
                        placeholder="Date"
                        required
                        class="bg-green4 border-2 border-green1 rounded-[20px] pl-8 pr-2 w-[140px] h-[33px] focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-[20px] uppercase text-center"
                    />
                    <img src="{{ asset('images/Date.svg') }}" alt="Logo Date" class="absolute top-1/2 -translate-y-1/2 pl-2">
                </div>

                <div class="relative top-[174px]">
                    <!--<label for="passager">Passager</label>-->
                    <input
                        type="text"
                        id="passager"
                        name="passager"
                        placeholder="Passager"
                        required
                        class="bg-green4 border-2 border-green1 rounded-[20px] pl-8 pr-2 w-[140px] h-[33px] focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-[20px] uppercase text-center"
                    />
                    <img src="{{ asset('images/NombreDePassager.svg') }}" alt="Logo nombre de passager" class="absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
            </div>

            <div class="flex justify-center">
                <button
                class="relative bg-green4 border-2 border-green1 rounded-[20px] top-[190px] w-[140px] h-[33px] font-second text-[20px] uppercase text-center" type="submit">
                <img src="{{ asset('images/Recherche.svg') }}" alt="Logo recherche" class="absolute top-1/2 -translate-y-1/2 pl-2">
                Chercher
                </button>
            </div>

        </form>

    </div>

@endsection