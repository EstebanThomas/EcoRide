
@extends('layouts.app')

@section('content')

    <!--Form search route-->
    <div>

        <form action="/Recherche-covoiturage" method="GET" class="flex flex-col mt-8">

            <div class="flex flex-row w-full justify-center gap-4">
                <div class="relative top-[260px]">
                    <!--<label for="depart">Départ</label>-->
                    <input
                        type="text"
                        id="depart"
                        name="depart"
                        placeholder="Départ"
                        required
                        class="bg-green4 border-2 border-green1 rounded-[20px] pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                    />
                    <img src="{{ asset('images/Depart.svg') }}" alt="Logo Depart" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
                
                <div class="relative top-[260px]">
                    <!--<label for="destination">Destination</label>-->
                    <input
                        type="text"
                        id="destination"
                        name="destination"
                        placeholder="Destination"
                        required
                        class="bg-green4 border-2 border-green1 rounded-[20px] pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                    />
                    <img src="{{ asset('images/Arrivee.svg') }}" alt="Logo Destination" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
            </div>

            <div class="flex flex-row w-full justify-center gap-4">
                <div class="relative top-[275px]">
                    <!--<label for="date">Date</label>-->
                    <input
                        type="text"
                        id="date"
                        name="date"
                        placeholder="Date"
                        required
                        class="bg-green4 border-2 border-green1 rounded-[20px] pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                    />
                    <img src="{{ asset('images/Date.svg') }}" alt="Logo Date" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>

                <div class="relative top-[275px]">
                    <!--<label for="passager">Passager</label>-->
                    <input
                        type="text"
                        id="passager"
                        name="passager"
                        placeholder="Passager"
                        required
                        class="bg-green4 border-2 border-green1 rounded-[20px] pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                    />
                    <img src="{{ asset('images/NombreDePassager.svg') }}" alt="Logo nombre de passager" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
            </div>

            <div class="flex justify-center">
                <button
                class="relative bg-green4 border-2 border-green1 rounded-[20px] top-[290px] w-sm h-18 font-second text-4xl uppercase text-center" type="submit">
                <img src="{{ asset('images/Recherche.svg') }}" alt="Logo recherche" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                Chercher
                </button>
            </div>

        </form>

    </div>

@endsection