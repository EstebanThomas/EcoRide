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

                <h2 class="font-second text-5xl text-black text-center mt-2 mb-2 uppercase">
                    Créer un compte employé
                </h2>

                <div class="flex flex-col p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <label for="pseudo" class="font-second text-4xl">PSEUDO</label>
                    <input type="text" id="pseudo" name="pseudo" placeholder="Entrez un pseudo" required
                    class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase placeholder-black p-2"/>
                </div>

                <div class="flex flex-col p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <label for="mail" class="font-second text-4xl">MAIL</label>
                    <input type="email" id="mail" name="mail" placeholder="Entrez un adresse mail valide" required
                    class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase placeholder-black p-2"/>
                </div>

                <div class="flex flex-col p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <div>
                        <label for="password" class="font-second text-4xl">MOT DE PASSE</label>
                        <input type="password" id="password" name="password" placeholder="Entrez un mot de passe valide" required minlength="12" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{12,}$"
                        title="Le mote de passe doit contenir : au moins 12 caractères, au moins une minuscule, au moins une majuscule et au moins un chiffre."
                        class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-2"/>
                    </div>

                <div class="flex flex-col justify-center items-center mt-2 p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <button type="submit" class="uppercase border-2 border-black text-4xl font-second bg-green1 hover:bg-green2 active:bg-green1 rounded-3xl w-2xs h-18 xl:w-3xs xl:h-12">
                        Enregistrer
                    </button>
                </div>

            </form>
        </div>
    </div>

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

@endsection