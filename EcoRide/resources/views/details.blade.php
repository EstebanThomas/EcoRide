@extends('layouts.app')

@section('content')

    <div class="w-full h-full mt-75 xl:mt-5 flex justify-center items-center flex-col">
        <div class="flex flex-row ml-2 mr-2">
            <div class="flex flex-row justify-center items-center gap-5 w-2/3 border-4 border-green1 rounded-3xl p-1">
                <div>
                    @if($covoiturage->utilisateur->photo)
                        <img src="{{ asset('storage/' .$covoiturage->utilisateur->photo) }}" alt="Photo utilisateur" class="w-30 h-30 rounded-3xl object-cover m-10">
                    @else
                        <img src="{{ asset('images/PhotoDeProfilDefaut.png') }}" alt="Photo utilisateur par défaut" class="w-30 h-30 rounded-3xl object-cover m-10">
                    @endif
                </div>
                <div class="m-5 ml-15">
                    <p class="text-4xl font-second text-center text-black">{{ $covoiturage->utilisateur->pseudo }}</p>
                </div>
                <div class="flex flex-col justify-center items-center gap-2 border border-green1 rounded-3xl bg-green4 p-5 mr-5">
                    <p class="text-4xl font-second text-black uppercase">{{ $covoiturage->voiture->marque->libelle }}</p>
                    <p class="text-4xl font-second text-black uppercase">{{ $covoiturage->voiture->modele }}</p>
                    @if($covoiturage->voiture->energie === 'Oui')
                        <p class="text-4xl font-second text-black uppercase">électrique</p>
                    @endif
                </div>
            </div>
            @if ($alreadyParticipating)
                <form action="{{ route('covoiturage.quitter', ['id' => $covoiturage->covoiturage_id]) }}" method="POST" class="flex justify-center items-center w-1/3">
                    @csrf
                    <button type="submit"
                    class="flex flex-col items-center justify-center text-4xl font-second text-black gap-2 border-4 rounded-3xl border-green1 hover:border-black hover:bg-green4 hover:underline hover:decoration-green1 active:border-green1 active:decoration-black p-5 pt-20 pb-20">
                        <img src="{{ asset('images/Croix.svg') }}" alt="Logo participer" class="w-15 h-15">
                        QUITTER
                    </button>
                </form>
            @else
                <form action="{{ route('covoiturage.participer', ['id' => $covoiturage->covoiturage_id]) }}" method="POST" id="formParticiper" class="flex justify-center items-center w-1/3">
                    @csrf
                    <button type="button" onclick="confirmerParticipation()"
                    class="flex flex-col items-center justify-center text-4xl font-second text-black gap-2 border-4 rounded-3xl border-green1 hover:border-black hover:bg-green4 hover:underline hover:decoration-green1 active:border-green1 active:decoration-black p-5 pt-20 pb-20">
                        <img src="{{ asset('images/Participer.svg') }}" alt="Logo participer" class="w-15 h-15">
                        PARTICIPER
                    </button>
                </form>
            @endif
        @if($user)
            <div class="flex flex-row items-center justify-center gap-2 w-80">
                <p class="text-5xl font-second text-black">Vous avez : {{$user->credits}}</p>
                <img src="{{ asset('images/Credit.svg') }}" alt="Logo crédit" class="w-10 h-10">
            </div>
        @else
            <div class="flex flex-row items-center justify-center w-100">
                <p class="text-5xl font-second text-black">Vous devez vous <a class="underline decoration-green1 hover:text-green1 hover:decoration-black" href="/connexion">connecter</a> pour participer</p>
            </div>
        @endif
        </div>
        <div class="flex flex-col justify-center items-center border-4 border-green1 p-5 rounded-3xl mt-5 w-4/6">
            <p class="text-center font-second text-black text-4xl uppercase">préférences</p>
            <div class="flex flex-row justify-center items-center gap-20">
                <div class="flex flex-row justify-center items-center gap-5 bg-green4 border-2 border-green1 rounded-3xl p-2 mt-5">
                    <p class="font-second text-black text-4xl uppercase">Fumeurs<p>
                    @if($covoiturage->fumeur === 'Oui')
                        <img src="{{ asset('images/Fumeur.svg') }}" alt="Logo fumeur acceptés" class="w-10 h-10">
                    @else
                        <img src="{{ asset('images/NonFumeur.svg') }}" alt="Logo fumeur refusés" class="w-10 h-10">
                    @endif
                </div>
                <div class="flex flex-row justify-center items-center gap-5 bg-green4 border-2 border-green1 rounded-3xl p-2 mt-5">
                    <p class="font-second text-black text-4xl uppercase">Animaux<p>
                    @if($covoiturage->fumeur === 'Oui')
                        <img src="{{ asset('images/Animal.svg') }}" alt="Logo animaux acceptés" class="w-10 h-10">
                    @else
                        <img src="{{ asset('images/PasAnimal.svg') }}" alt="Logo animaux refusés" class="w-10 h-10">
                    @endif
                </div>
            </div>
            @if(!empty($covoiturage->utilisateur->preferences->propres_preferences))
                <div class="border-2 border-green1 rounded-3xl bg-green4 p-2 mt-5">
                    <p class="font-second text-black text-4xl">{{$covoiturage->utilisateur->preferences->propres_preferences}}<p>
                </div>
            @endif
        </div>

        <div class="bg-white border-4 border-green1 rounded-3xl w-4/6 h-full flex flex-col mt-5 gap-5">
            <div class="border-b-4 border-green1 w-full h-1/2 flex flex-row gap-3 p-5 justify-center items-center">
                <div class="flex flex-row items-center justify-center w-full h-full gap-2 font-second text-5xl text-black">
                    {{ $covoiturage->nb_place }}
                    <img src="{{ asset('images/NombreDePassager.svg') }}" alt="Logo nombre de passager" class="w-10 h-10">
                </div>
                <div class="flex flex-row items-center justify-center w-full h-full gap-2 font-second text-5xl text-black">
                    {{ $covoiturage->prix_personne }}
                    <img src="{{ asset('images/Credit.svg') }}" alt="Logo crédit" class="w-10 h-10">
                </div>
                @if($covoiturage->voiture->energie === 'Oui')
                    <div class="flex items-center justify-center w-full h-full gap-1">
                        <img src="{{ asset('images/Ecologique.svg') }}" alt="Logo energie électrique" class="w-10 h-10">
                    </div>
                @endif
            </div>
            <div class="w-full h-1/2 flex flex-col justify-center items-center gap-10 p-5">
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
                                {{ \Carbon\Carbon::parse($covoiturage->heure_depart)->format('H:i') }} de {{ $covoiturage->lieu_depart }}
                            </p>
                    </div>
                    <div class="flex flex-row items-center justify-center gap-2">
                        <img src="{{ asset('images/Arrivee.svg') }}" alt="Logo de la date d'arrivée" class="w-10 h-10">
                        <p class="font-second text-5xl text-black">
                            {{ \Carbon\Carbon::parse($covoiturage->heure_arrivee)->format('H:i') }} à {{ $covoiturage->lieu_arrivee }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!--Reviews-->
        <div class="mt-5 w-3/4 flex flex-col justify-center items-center mb-5">
            <h1 class="text-6xl font-second text-black uppercase m-2">
                AVIS
            </h1>
            <div class="border-4 rounded-3xl w-3/4 border-green1 p-2 overflow-y-auto h-200 flex flex-col items-center gap-4">
                @forelse($avis as $a)
                    <div class="border-3 border-green2 rounded-3xl p-4 my-2 w-full xl:w-200 text-5xl font-second">
                        <p class="flex flex-row justify-center items-center gap-5 p-1">
                            @if($covoiturage->utilisateur->photo)
                                <img src="{{ asset('storage/' .$a->utilisateur->photo) }}" alt="Photo utilisateur" class="w-30 h-30 rounded-full object-cover m-2 border">
                            @else
                                <img src="{{ asset('images/PhotoDeProfilDefaut.png') }}" alt="Photo utilisateur par défaut" class="w-30 h-30 rounded-full object-cover m-2 border">
                            @endif
                            {{ $a->utilisateur->pseudo }}
                        </p>
                        <p class="flex flex-row justify-center items-center gap-2 p-1">
                            {{ $a->note }} / 5
                            <img src="{{ asset('images/Note.svg') }}" alt="Logo crédit" class="w-10 h-10">
                        </p>
                        <p class="flex justify-center items-center">
                            {{ $a->good_trip ? 'Le voyage s\'est bien passé' : 'Le voyage ne s\'est pas bien passé' }}
                        </p>
                        <p><strong>Commentaire :</strong><br> {{ $a->commentaire }}</p>
                    </div>
                @empty
                    <p class="text-4xl font-second text-gray-600">Aucun avis n’a encore été publié sur ce conducteur.</p>
                @endforelse
            </div>

        </div>

    </div>

    @if(session('successParticipation'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: @json(session('successParticipation')),
                    icon: 'success',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @elseif(session('errorParticipation'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Erreur !',
                    icon: 'error',
                    text: @json(session('errorParticipation')),
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @endif

    <script>

        //Confirm alert
        function confirmerParticipation() {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous allez dépenser {{ $covoiturage->prix_personne }} crédits",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Participer',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                customClass:{
                        popup: 'custom-swal'
                    }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formParticiper').submit();
                }
            });
        }

    </script>

@endsection