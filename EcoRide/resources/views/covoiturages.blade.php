@extends('layouts.app')

@section('content')

    @php
        $today = now()->format('Y-m-d');
    @endphp

    <div class="flex flex-col items-center justify-center mt-75">

        <form method="POST" action="{{ route('covoiturage.rechercher') }}" class="flex flex-col justify-center items-center gap-10">
            @csrf
            <div class="flex flex-row justify-center items-center gap-10">
                <input type="text" id="lieu_depart" name="lieu_depart" required
                class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                placeholder="Départ"/>

                <input type="text" id="lieu_arrivee" name="lieu_arrivee" required
                class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                placeholder="Arrivée"/>
            </div>
            <div class="flex flex-row justify-center items-center gap-10">
                <input type="date" id="date_depart" name="date_depart" required
                class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center flex justify-center placeholder-black"
                placeholder="{{$today}}"
                value="{{$today}}"/>

                <input type="integer" id="nb_place" name="nb_place" required
                class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl uppercase text-center placeholder-black"
                placeholder="1" value="1"/>
            </div>
            <button type="submit" class="text-4xl font-second tracking-wide border-2 border-black bg-green1 rounded-3xl p-3 pl-10 pr-10 hover:bg-green2">
            CHERCHER
            </button>
        </form>
    </div>

@endsection