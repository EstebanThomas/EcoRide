@extends('layouts.app')

@section('content')
    <div class="w-full h-full mt-75 mb-10 xl:mt-5 xl:mb-0">
        <div class="flex flex-col justify-center h-181 mb-50 ml-20 mr-20 2xl:ml-100 2xl:mr-100 2xl:mb-5">
            <form method="POST" action="{{ route('utilisateur.connexion') }}">
                @csrf
                <div class="flex flex-col border-2 border-green1 rounded-t-3xl p-20 pt-10 pb-10">
                    <label for="mail" class="font-second text-4xl">MAIL</label>
                    <input type="email" id="mail" name="mail" placeholder="Entrez un adresse mail valide" required
                    class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase placeholder-black p-2"/>
                </div>
                <div class="flex flex-col border-2 border-t-0 border-b-0 border-green1 p-20 pt-10 pb-10">
                    <label for="password" class="font-second text-4xl">MOT DE PASSE</label>
                    <input type="password" id="password" name="password" placeholder="Entrez le mot de passe" required

                    class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase placeholder-black p-2"/>
                </div>
                <div class="flex flex-col border-2 border-green1 rounded-b-3xl p-20 pt-10 pb-10">
                    <div class="flex flex-col items-center justify-center gap-4">
                        <button type="submit" class="border-2 border-black text-4xl font-second bg-green1 hover:bg-green2 active:bg-green1 rounded-3xl w-2xs h-18 xl:w-3xs xl:h-12">
                            CONNEXION
                        </button>
                        <p class="text-2xl font-second">
                            Si vous n'avez pas de compte : <a href="/creation-compte" class="underline underline-offset-1 decoration-green1 hover:text-green1 hover:decoration-black active:text-black active:decoration-green1">Créer un compte</a>
                        </p>
                    </div>
                </div>
            </form>

                <!--Show Errors-->
            <div class="flex justify-center">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500 font-second text-2xl">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif   
            </div>
        </div>
    </div> 

@endsection