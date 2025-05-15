@extends('layouts.app')

@section('content')
    
    <div class="flex flex-col justify-center items-center m-75 mb-10 xl:mt-5">
        <h1 class="font-main text-6xl text-green1 uppercase text-shadow-lg">
            Employé
        </h1>
        <div class="border-2 border-green1 rounded-3xl p-5 xl:w-300 w-200 h-200 m-5 overflow-y-auto">
            <h2 class="font-second text-5xl text-black uppercase text-center">
                AVIS A VALIDER
            </h2>
            @foreach($avisValidation as $avis)
                <div class="border-2 border-green1 rounded-3xl p-4 m-4 font-second text-4xl flex flex-col justify-center items-center gap-2">
                    <p><strong>Utilisateur :</strong> {{ $avis->utilisateur->pseudo }}</p>
                    <p><strong>Note :</strong> {{ $avis->note }} / 5</p>
                    <p><strong>Commentaire :</strong> {{ $avis->commentaire }}</p>
                    <p><strong>Bon voyage :</strong> {{ $avis->good_trip ? 'Oui' : 'Non' }}</p>
                    <p><strong>Conducteur :</strong> {{ $avis->covoiturage->utilisateur->pseudo}}</p>

                    @if ($avis->covoiturage)
                        <p><strong>Trajet :</strong> De {{ $avis->covoiturage->lieu_depart }} à {{ $avis->covoiturage->lieu_arrivee }}</p>
                        <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($avis->covoiturage->date_depart)->format('d/m/Y') }}</p>
                    @endif

                    <!-- Actions (valider / refuser) -->
                    <div class="flex flex-row justify-center items-center gap-2">
                        <form action="{{ route('avis.valider', $avis->avis_id) }}" method="POST" class="inline-block mr-2">
                            @csrf
                            <button class="bg-green1 hover:bg-green2 active:bg-green1 border-2 p-2 rounded-3xl">Valider</button>
                        </form>

                        <form action="{{ route('avis.refuser', $avis->avis_id) }}" method="POST" class="inline-block">
                            @csrf
                            <button class="bg-red-500 hover:bg-red-400 active:bg-red-500 border-2 p-2 rounded-3xl">Refuser</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection