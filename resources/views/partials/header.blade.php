<header>

    <!--Larger than Smartphone-->
    <div class="relative hidden xl:block">

        <img src="{{ asset('images/EcoRide_Logo_WiBg.png') }}" alt="Logo" class="absolute max-h-none max-w-none w-[200px] h-[100px] left-[30px] top-1/2 -translate-y-1/2 2xl:left-[60px] 2xl:w-[259px] 2xl:h-[118px]">

        <nav class="absolute flex justify-evenly items-center w-[800px] h-[75] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white rounded-3xl p-2"> <!-- xs:top-[45px] left-1/2 and top-1/2 = put corner high right center and -translate-x-1/2 -translate-y-1/2 = recenter -->
            <a class="font-second text-2xl xl:text-xl tracking-wide flex w-[200px] h-[55px] items-center justify-center flex-col hover:text-green1 active:text-black" href="/"><img src="{{ asset('Images/Accueil.svg') }}" alt="Logo Accueil">ACCUEIL</a>
            <a class="font-second text-2xl xl:text-xl tracking-wide flex w-[200px] h-[55px] items-center justify-center flex-col hover:text-green1 active:text-black" href="/covoiturages"><img src="{{ asset('Images/Covoiturages.svg') }}" alt="Logo Covoiturages">COVOITURAGES</a>
            <a class="font-second text-2xl xl:text-xl tracking-wide flex w-[200px] h-[55px] items-center justify-center flex-col hover:text-green1 active:text-black" href="/connexion"><img src="{{ asset('Images/Connexion.svg') }}" alt="Logo Connexion">CONNEXION</a>
            <a class="font-second text-2xl xl:text-xl tracking-wide flex w-[200px] h-[55px] items-center justify-center flex-col hover:text-green1 active:text-black" href="/contact"><img src="{{ asset('Images/Contact.svg') }}" alt="Logo Contact">CONTACT</a>
        </nav>

        @Auth
            <button class="hover:bg-green4 active:bg-green1 absolute text-xl uppercase tracking-wide font-second flex justify-center items-center rounded-3xl bg-white p-2 leading-6 top-1/2 left-8/9 -translate-x-1/2 -translate-y-1/2"
            onclick="window.location.href='/espace-utilisateur'">
            Accéder au profil<br>{{ Auth::user()->pseudo }}
            </button>

            @php
                $role = Auth::user()->role_id;
            @endphp

            @if($role === 1)            <!--BUTTON ADMINISTRATION-->
                <form action="{{ route('espaceAdministrateur') }}" method="POST">
                    @csrf
                    <button type="submit"
                    class="absolute leading-6 top-3/4 left-8/9 -translate-x-1/2 uppercase border-2 border-black text-xl font-second bg-white hover:bg-gray-200 active:bg-white rounded-3xl p-1">
                    ADMINISTRATION
                    </button>
                </form>
            @elseif($role === 2)        <!--BUTTON EMPLOYEES-->
                <form action="{{ route('espaceEmploye') }}" method="POST">
                    @csrf
                    <button type="submit"
                    class="absolute leading-6 top-3/4 left-8/9 -translate-x-1/2 uppercase border-2 border-black text-xl font-second bg-white hover:bg-gray-200 active:bg-white rounded-3xl p-1">
                    Employés
                    </button>
                </form>
            @endif

        
        @endAuth

        <div class="bg-green4 w-full h-[35px]"></div>
        <div class="bg-green3 w-full h-[35px]"></div>
        <div class="bg-green2 w-full h-[35px]"></div>
        <div class="bg-green1 w-full h-[35px]"></div>

    </div>

    <!--Smartphone-->
    <div class="relative block xl:hidden">

        <img src="{{ asset('images/EcoRide_Logo_WiBg.png') }}" alt="Logo" class="absolute w-[300px] h-[150px] top-[80px] left-1/2 -translate-x-1/2">

        <nav class="absolute flex justify-evenly items-center h-[110px] w-[calc(100%-4rem)] top-[230px] left-1/2 -translate-x-1/2 bg-green4 rounded-3xl border border-green1 p-2"> <!-- left-1/2 and top-1/2 = put corner high right center and -translate-x-1/2 -translate-y-1/2 = recenter -->
            <a class="font-second text-3xl tracking-wide flex w-[200px] h-[55px] items-center justify-center flex-col" href="/"><img src="{{ asset('Images/Accueil.svg') }}" alt="Logo Accueil" class="w-15 h-15">ACCUEIL</a>
            <a class="font-second text-3xl tracking-wide flex w-[200px] h-[55px] items-center justify-center flex-col" href="/covoiturages"><img src="{{ asset('Images/Covoiturages.svg') }}" alt="Logo Covoiturages" class="w-15 h-15">COVOITURAGES</a>
            <a class="font-second text-3xl tracking-wide flex w-[200px] h-[55px] items-center justify-center flex-col" href="/connexion"><img src="{{ asset('Images/Connexion.svg') }}" alt="Logo Connexion" class="w-15 h-15">CONNEXION</a>
            <a class="font-second text-3xl tracking-wide flex w-[200px] h-[55px] items-center justify-center flex-col" href="/contact"><img src="{{ asset('Images/Contact.svg') }}" alt="Logo Contact" class="w-15 h-15">CONTACT</a>
        </nav>

        @Auth
            <button class="active:bg-green1 active:border-black border border-green1 absolute text-4xl tracking-wide font-second flex justify-center items-center rounded-3xl bg-green4 p-3 leading-8 top-[120px] left-5/6 -translate-x-1/2 whitespace-nowrap"
            onclick="window.location.href='/espace-utilisateur'">
            Accéder au profil<br>{{ Auth::user()->pseudo }}
            </button>

            @php
                $role = Auth::user()->role_id;
            @endphp

            @if($role === 1)            <!--BUTTON ADMINISTRATION-->
                <form action="{{ route('espaceAdministrateur') }}" method="POST">
                    @csrf
                    <button type="submit"
                    class="absolute leading-8 top-[140px] left-1/6 -translate-x-1/2 whitespace-nowrap uppercase border-2 border-black text-4xl font-second bg-white hover:bg-gray-200 active:bg-white rounded-3xl p-3">
                    ADMINISTRATION
                    </button>
                </form>
            @elseif($role === 2)        <!--BUTTON EMPLOYEES-->
                <form action="{{ route('espaceEmploye') }}" method="POST">
                    @csrf
                    <button type="submit"
                    class="absolute leading-8 top-[140px] left-1/6 -translate-x-1/2 whitespace-nowrap uppercase border-2 border-black text-4xl font-second bg-white hover:bg-gray-200 active:bg-white rounded-3xl p-3">
                    Employés
                    </button>
                </form>
            @endif
        @endAuth

        <div class="bg-green4 w-full h-[20px]"></div>
        <div class="bg-green3 w-full h-[20px]"></div>
        <div class="bg-green2 w-full h-[20px]"></div>
        <div class="bg-green1 w-full h-[20px]"></div>

    </div>

</header>
