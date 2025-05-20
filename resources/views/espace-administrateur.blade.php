@extends('layouts.app')

@section('content')
    
    <div class="flex flex-col justify-center items-center m-75 mb-10 xl:mt-5">
        <h1 class="font-main text-6xl text-green1 uppercase text-shadow-lg">
            ADMINISTRATION
        </h1>

        <!--Create employees-->
        <div>
            <form method="POST" action="{{ route('employe.creation') }}" class="mt-10 border-2 border-green1 rounded-3xl">

                @csrf

                <h2 class="font-second text-5xl xl:text-3xl text-black text-center mt-2 mb-2 uppercase">
                    Créer un compte employé
                </h2>

                <div class="flex flex-col p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <label for="pseudo" class="font-second text-4xl xl:text-2xl">PSEUDO</label>
                    <input type="text" id="pseudo" name="pseudo" placeholder="Entrez un pseudo" required
                    class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase placeholder-black p-2"/>
                </div>

                <div class="flex flex-col p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <label for="mail" class="font-second text-4xl xl:text-2xl">MAIL</label>
                    <input type="email" id="mail" name="mail" placeholder="Entrez un adresse mail valide" required
                    class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase placeholder-black p-2"/>
                </div>

                <div class="flex flex-col p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <div>
                        <label for="password" class="font-second text-4xl xl:text-2xl">MOT DE PASSE</label>
                        <input type="password" id="password" name="password" placeholder="Entrez un mot de passe valide" required minlength="12" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{12,}$"
                        title="Le mote de passe doit contenir : au moins 12 caractères, au moins une minuscule, au moins une majuscule et au moins un chiffre."
                        class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-2"/>
                    </div>

                <div class="flex flex-col justify-center items-center mt-2 p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <button type="submit" class="flex justify-center items-center uppercase border-2 border-black text-4xl xl:text-2xl font-second bg-green1 hover:bg-green2 active:bg-green1 rounded-3xl w-2xs h-18 xl:w-3xs xl:h-12 p-1">
                        Enregistrer
                    </button>
                </div>

            </form>
        </div>

        <!--Suspend an account-->
        <div class="mt-10 border-2 border-green1 rounded-3xl">
            <h2 class="font-second text-5xl xl:text-3xl text-black text-center mt-2 mb-2 uppercase pl-20 pr-20">
                Suspendre un compte
            </h2>
            <h2 class="font-second text-4xl xl:text-2xl text-black text-center mt-2 mb-2 uppercase pl-20 pr-20">
                Comptes employés
            </h2>
            @foreach ($utilisateurs as $user)
                <div class="flex flex-col justify-center items-center gap-2 border rounded-3xl border-black m-4 ml-10 mr-10">
                    <p class="text-3xl xl:text-2xl font-second text-black">{{ $user->pseudo }}</p>
                    <p class="text-3xl xl:text-2xl font-second text-black">{{ $user->email }}</p>
                    <p>
                        @if ($user->suspendu)
                            <form action="{{ route('admin.reactiver', $user->utilisateur_id) }}" method="POST">
                                @csrf
                                <button class="uppercase border-2 border-black text-3xl xl:text-2xl font-second bg-green1 hover:bg-green2 active:bg-green1 rounded-3xl p-1">
                                    Réactiver
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.suspendre', $user->utilisateur_id) }}" method="POST">
                                @csrf
                                <button class="uppercase border-2 border-black text-3xl xl:text-2xl font-second bg-red-500 hover:bg-red-400 active:bg-red-500 rounded-3xl p-1">
                                    Suspendre
                                </button>
                            </form>
                        @endif
                    </p>
                </div>
            @endforeach

            <!--Search an account-->
            <form method="POST" action="{{ route('admin.rechercher') }}" class="m-4 border-2 border-green1 rounded-3xl flex flex-col justify-center items-center gap-2 p-2">
                @csrf
                <input type="email" name="email" required placeholder="Entrer un email" class="text-3xl xl:text-2xl font-second bg-gray-200 rounded-3xl p-1 text-center">
                <button type="submit" class="uppercase border-2 border-black text-3xl xl:text-2xl font-second bg-green1 hover:bg-green2 active:bg-green1 rounded-3xl p-1">
                    Rechercher
                </button>
            </form>

            @if(isset($utilisateurSearch))
                <div class="m-5 border-2 border-green1 rounded-3xl p-2 flex flex-col justify-center items-center gap-2">
                    <p class="text-3xl xl:text-2xl font-second">Pseudo : {{ $utilisateurSearch->pseudo }}</p>
                    <p class="text-3xl xl:text-2xl font-second">Email : {{ $utilisateurSearch->email }}</p>
                    <p class="text-3xl xl:text-2xl font-second">Rôle : {{ $utilisateurSearch->roles->libelle }}</p>
                    @if ($utilisateurSearch->suspendu)
                        <form action="{{ route('admin.reactiver', $utilisateurSearch->utilisateur_id) }}" method="POST">
                            @csrf
                            <button class="uppercase border-2 border-black text-3xl xl:text-2xl font-second bg-green1 hover:bg-green2 active:bg-green1 rounded-3xl p-1">
                                Réactiver
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.suspendre', $utilisateurSearch->utilisateur_id) }}" method="POST">
                            @csrf
                            <button class="uppercase border-2 border-black text-3xl xl:text-2xl font-second bg-red-500 hover:bg-red-400 active:bg-red-500 rounded-3xl p-1">
                                Suspendre
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </div>

        <!--Gaphics-->
        
        <div>
            <p class="uppercase text-4xl xl:text-2xl font-second m-5 flex flex-row justify-center items-center gap-1">
                Total de crédits gagné par la plateforme : 
                <p class="uppercase text-3xl font-second flex flex-row justify-center items-center gap-2">
                    {{Auth::user()->credits}}
                    <img src="{{ asset('images/Credit.svg') }}" alt="Logo crédit" class="w-10 h-10">
                </p>
            </p>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div class="m-5">
                <canvas id="covoiturageChart" width="600" height="400"></canvas>
                <script>
                    const ctx = document.getElementById('covoiturageChart').getContext('2d');

                    const chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($dataCovoiturages->pluck('jour')) !!},
                            datasets: [{
                                label: 'Nombre de covoiturages par jour',
                                data: {!! json_encode($dataCovoiturages->pluck('total')) !!},
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                fill: true,
                                tension: 0.4,
                            }]
                        },
                        options: {
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Jour'
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Nombre de covoiturages'
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <div class="m-5">
            <canvas id="creditsChart" width="600" height="400"></canvas>

            <script>
                const ctx2 = document.getElementById('creditsChart').getContext('2d');
                const chart2 = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($dataCommission->pluck('date')) !!},
                        datasets: [{
                            label: 'Crédits gagnés',
                            data: {!! json_encode($dataCommission->pluck('total_credits')) !!},
                            backgroundColor: 'rgba(34, 197, 94, 0.2)',
                            borderColor: 'rgba(34, 197, 94, 1)',
                            borderWidth: 2,
                            fill: true
                        }]
                    }
                });
            </script>
        </div>
    </div>

    <!--POPUPS INFORMATIONS-->
    @if (!empty($errorCreateAccount))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Erreur !',
                    text: @json($errorCreateAccount),
                    icon: 'error',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @endif

    @if (!empty($successCreateAccount))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Compte créé !',
                    text: @json($successCreateAccount),
                    icon: 'success',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @endif

    @if(!empty($successDesactivate))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: @json($successDesactivate),
                    icon: 'success',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @endif

    @if(!empty($successActivate))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: @json($successActivate),
                    icon: 'success',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @endif

    @if(!empty($errorSuspend))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: @json($errorSuspend),
                    icon: 'error',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @endif

    @if(!empty($successSearch))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: @json($successSearch),
                    icon: 'success',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @endif
@endsection