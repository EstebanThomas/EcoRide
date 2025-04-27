@extends('layouts.app')

@section('content')
    <div class="w-full h-full mt-100 mb-10 xl:mt-5 xl:mb-0">
        <div class="flex flex-col justify-center h-181 mb-50 ml-20 mr-20 2xl:ml-150 2xl:mr-150 2xl:mb-5">
            <form>
            
                <div class="flex flex-col border-2 border-green1 rounded-t-3xl p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <label for="pseudo" class="font-second text-4xl">PSEUDO</label>
                    <input type="text" id="pseudo" name="pseudo" placeholder="Entrez un pseudo" required
                    class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase placeholder-black p-2"/>
                </div>


                <div class="flex flex-col border-2 border-green1 border-t-0 border-b-0 p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <label for="mail" class="font-second text-4xl">MAIL</label>
                    <input type="email" id="mail" name="mail" placeholder="Entrez un adresse mail valide" required
                    class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase placeholder-black p-2"/>
                </div>

                <div class="flex flex-col border-2 border-t-2 border-b-0 border-green1 p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                    <div>
                        <label for="mdp" class="font-second text-4xl">MOT DE PASSE</label>
                        <input type="text" id="mdp" name="mdp" placeholder="Entrez un mot de passe valide" required
                        class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase placeholder-black p-2"/>
                    </div>
                    <div>
                        <p class="flex justify-center font-second text-xl uppercase mt-2">
                            Le mote de passe doit contenir :
                        </p>
                        <div class="flex flex-row justify-center gap-10">
                            <div class="flex flex-col justify-center">
                                <p class="font-second text-xl uppercase">
                                    Au moins 12 caractères
                                </p>
                                <p class="font-second text-xl uppercase mb-2">
                                    Au moins une minuscule
                                </p>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p class="font-second text-xl uppercase">
                                    Au moins une majuscule
                                </p>
                                <p class="font-second text-xl uppercase mb-2">
                                    Au moins un chiffre
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                    <label for="mdp" class="font-second text-4xl">CONFIRMATION DU MOT DE PASSE</label>
                        <input type="text" id="mdp" name="mdp" placeholder="Entrez le mot de passe" required
                        class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl uppercase placeholder-black p-2"/>
                    </div>
                </div>

                <div class="flex flex-col justify-center items-center border-2 border-green1 rounded-b-3xl p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                        <button class="border-2 border-black text-4xl font-second bg-green1 rounded-3xl w-2xs h-18 xl:w-3xs xl:h-12">
                            INSCRIPTION
                        </button>
                </div>

            </form>
        </div>
    </div>
@endsection