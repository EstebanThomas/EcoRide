
@extends('layouts.app')

@section('content')

    @php
        $today = now()->startOfDay()->format('Y-m-d');
    @endphp

    <!--Form search route-->
    <div class="mt-75 xl:mt-0">

        <form method="GET" action="{{ route('covoiturage.rechercher') }}" class="flex flex-col mt-8">

            <div class="flex flex-row w-full justify-center gap-4">
                <div class="relative">
                    <!--<label for="lieu_depart">Départ</label>-->
                    <input type="text" id="lieu_depart" name="lieu_depart" placeholder="Départ" required
                    class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-5xl uppercase text-center placeholder-gray-500"/>
                    <img src="{{ asset('images/Depart.svg') }}" alt="Logo Depart" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
                
                <div class="relative">
                    <!--<label for="lieu_arrivee">Destination</label>-->
                    <input type="text" id="lieu_arrivee" name="lieu_arrivee" placeholder="Destination" required
                    class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 font-second text-5xl uppercase text-center placeholder-gray-500"/>
                    <img src="{{ asset('images/Arrivee.svg') }}" alt="Logo Destination" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
            </div>

            <div class="flex flex-row w-full justify-center gap-4">
                <div class="relative mt-4">
                    <!--<label for="date_depart">Date</label>-->
                    <input type="date" id="date_depart" name="date_depart" value="{{ $today }}" required
                    class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 font-second text-5xl uppercase text-center placeholder-black flex justify-center items-center"/>
                    <img src="{{ asset('images/Date.svg') }}" alt="Logo Date" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>

                <div class="relative mt-4">
                    <!--<label for="nb_place">Passager</label>-->
                    <input type="number" id="nb_place" name="nb_place" value="1" required min="1" max="7"
                    class="bg-green4 border-2 border-green1 rounded-3xl pl-8 pr-2 w-sm h-18 font-second text-5xl uppercase text-center placeholder-black"/>
                    <img src="{{ asset('images/NombreDePassager.svg') }}" alt="Logo nombre de passager" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                </div>
            </div>

            <div class="flex justify-center mt-4">
                <button
                class="relative bg-green4 border-2 border-green1 rounded-3xl w-sm h-18 font-second text-5xl uppercase text-center hover:border-black active:border-green1" type="submit">
                <img src="{{ asset('images/Recherche.svg') }}" alt="Logo recherche" class="w-15 h-15 absolute top-1/2 -translate-y-1/2 pl-2">
                Chercher
                </button>
            </div>

        </form>

    </div>

    <!--informations-->
    <div class="flex flex-col m-10 xl:mr-50 xl:ml-50">

        <div class="flex justify-evenly items-center">
            <p class="block xl:hidden font-second text-7xl text-green1 text-center">
                Le covoiturage<br> respecteux<br>de l’environnement.
            </p>
            <p class="hidden xl:block font-second text-6xl text-green1 text-center">
                Le covoiturage respecteux<br>de l’environnement.
            </p>
            <div class="w-100 h-75 xl:h-50 rounded-3xl overflow-hidden">
                <img src="{{ asset('images/VoitureHerbe.jpg') }}" alt="Photo d'un van dans l'herbe" class="max-w-111 xl:max-w-100">
            </div>
        </div>

        <div class="flex justify-evenly mt-5 xl:mt-1 items-center">
            <div class="w-100 h-75 xl:h-50 rounded-3xl overflow-hidden">
                <img src="{{ asset('images/VoitureElectrique.jpg') }}" alt="Photo d'une voiture électrique" class="max-w-111 xl:max-w-100">
            </div>
            <p class="block xl:hidden font-second text-7xl text-green1 text-center m-2">
                EcoRide s’engage<br>pour l’environnement<br>grâce à son système<br>de covoiturage avec<br>l’option «voyage écologique».
            </p>
            <p class="hidden xl:block font-second text-4xl text-green1 text-center m-2">
                EcoRide s’engage pour l’environnement<br>grâce à son système de covoiturage<br>avec l’option «voyage écologique».
            </p>
        </div>
    </div>

    <!-- Redirect ADMIN -->
    @if(session('redirect_admin'))
        <form id="redirectAdminForm" action="{{ route('espaceAdministrateur') }}" method="POST" style="display:none;">
            @csrf
        </form>
        <script>
            document.getElementById('redirectAdminForm').submit();
        </script>
    @endif

    <!-- Redirect EMPLOYEE -->
    @if(session('redirect_employe'))
        <form id="redirectEmployeForm" action="{{ route('espaceEmploye') }}" method="POST" style="display:none;">
            @csrf
        </form>
        <script>
            document.getElementById('redirectEmployeForm').submit();
        </script>
    @endif

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

    @if(session('successAvisRefus'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: @json(session('successAvisRefus')),
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
@endsection