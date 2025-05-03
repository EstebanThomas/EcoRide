@extends('layouts.app')

@section('content')
    <div class="w-full h-full mt-100 mb-10 xl:mt-5 xl:mb-0">
        <div class="flex flex-col justify-center h-181 mb-50 ml-20 mr-20 2xl:ml-100 2xl:mr-100 2xl:mb-5">
            <form method="POST" action="{{ route('utilisateur.creation') }}">

                @csrf

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
                        <label for="password" class="font-second text-4xl">MOT DE PASSE</label>
                        <input type="password" id="password" name="password" placeholder="Entrez un mot de passe valide" required minlength="12" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{12,}$"
                        title="Le mote de passe doit contenir : au moins 12 caractères, au moins une minuscule, au moins une majuscule et au moins un chiffre."
                        class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-2"
                        oninput="verificationPassword()"/>
                    </div>
                    <div>
                        <p class="flex justify-center font-second text-xl uppercase mt-2">
                            Le mote de passe doit contenir :
                        </p>
                        <div class="flex flex-row justify-center gap-10">
                            <div class="flex flex-col justify-center">
                                <p id="lengthError" class="font-second text-xl uppercase">
                                    Au moins 12 caractères
                                </p>
                                <p id="lowercaseError" class="font-second text-xl uppercase mb-2">
                                    Au moins une minuscule
                                </p>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p id="uppercaseError" class="font-second text-xl uppercase">
                                    Au moins une majuscule
                                </p>
                                <p id="numberError" class="font-second text-xl uppercase mb-2">
                                    Au moins un chiffre
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                    <label for="confirm_password" class="font-second text-4xl">CONFIRMATION DU MOT DE PASSE</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Entrez le mot de passe" required
                        class="bg-green4 w-full h-18 xl:h-10 focus:border-2 focus:border-green1 focus:outline focus:outline-green1 font-second text-4xl xl:text-2xl placeholder-black p-2"/>
                    </div>
                </div>

                <div class="flex flex-col justify-center items-center border-2 border-green1 rounded-b-3xl p-20 pt-10 pb-10 xl:pt-5 xl:pb-5">
                        <button type="submit" class="border-2 border-black text-4xl font-second bg-green1 hover:bg-green2 rounded-3xl w-2xs h-18 xl:w-3xs xl:h-12">
                            INSCRIPTION
                        </button>
                </div>

            </form>
        </div>
    </div>


    <!--verification same password and errors password-->
    <script>

    document.getElementById('formCreateAccount').addEventListener('submit', function(event) {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            alert('Les mots de passe ne correspondent pas.');
            event.preventDefault();
        }
    });

    function verificationPassword() {
        var password = document.getElementById('password').value;
        var lengthError = document.getElementById('lengthError');
        var lowercaseError = document.getElementById('lowercaseError');
        var uppercaseError = document.getElementById('uppercaseError');
        var numberError = document.getElementById('numberError');

        var isLengthValid = password.length >= 12;
        var hasLowercase = /[a-z]/.test(password);
        var hasUppercase = /[A-Z]/.test(password);
        var hasNumber = /\d/.test(password);

        if (!isLengthValid) {
            lengthError.classList.add('text-red-500');
            lengthError.classList.remove('text-black');
        }
        else{
            lengthError.classList.remove('text-red-500');
            lengthError.classList.add('text-black');
        }

        if (!hasLowercase) {
            lowercaseError.classList.add('text-red-500');
            lowercaseError.classList.remove('text-black');
        }
        else{
            lowercaseError.classList.remove('text-red-500');
            lowercaseError.classList.add('text-black');
        }

        if (!hasUppercase) {
            uppercaseError.classList.add('text-red-500');
            uppercaseError.classList.remove('text-black');
        }
        else{
            uppercaseError.classList.remove('text-red-500');
            uppercaseError.classList.add('text-black');
        }

        if (!hasNumber) {
            numberError.classList.add('text-red-500');
            numberError.classList.remove('text-black');
        }
        else{
            numberError.classList.remove('text-red-500');
            numberError.classList.add('text-black');
        }
    }
    </script>

@endsection