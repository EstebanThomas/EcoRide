<header>

    <!--Larger than Smartphone-->
    <div class="relative hidden xl:block">

        <img src="{{ asset('images/EcoRide_Logo_WiBg.png') }}" alt="Logo" class="absolute flex w-[200px] h-[91px] left-[30px] top-1/2 -translate-y-1/2 2xl:left-[60px] 2xl:w-[259px] 2xl:h-[118px]">

        <nav class="absolute flex justify-evenly items-center w-[800px] h-[65] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white rounded-[20px]"> <!-- xs:top-[45px] left-1/2 and top-1/2 = put corner high right center and -translate-x-1/2 -translate-y-1/2 = recenter -->
            <a class="font-second text-[24px] flex w-[200px] h-[55px] items-center justify-center flex-col" href="/"><img src="{{ asset('images/Accueil.svg') }}" alt="Logo Accueil">ACCUEIL</a>
            <a class="font-second text-[24px] flex w-[200px] h-[55px] items-center justify-center flex-col" href="/covoiturages"><img src="{{ asset('images/Covoiturages.svg') }}" alt="Logo Covoiturages">COVOITURAGES</a>
            <a class="font-second text-[24px] flex w-[200px] h-[55px] items-center justify-center flex-col" href="/connexion"><img src="{{ asset('images/Connexion.svg') }}" alt="Logo Connexion">CONNEXION</a>
            <a class="font-second text-[24px] flex w-[200px] h-[55px] items-center justify-center flex-col" href="/contact"><img src="{{ asset('images/Contact.svg') }}" alt="Logo Contact">CONTACT</a>
        </nav>

        <div class="bg-green4 w-full h-[35px]"></div>
        <div class="bg-green3 w-full h-[35px]"></div>
        <div class="bg-green2 w-full h-[35px]"></div>
        <div class="bg-green1 w-full h-[35px]"></div>

    </div>

    <!--Smartphone-->
    <div class="relative block xl:hidden">

        <img src="{{ asset('images/EcoRide_Logo_WiBg.png') }}" alt="Logo" class="absolute flex h-[83px] w-[187px] top-[45px] left-1/2 -translate-x-1/2">

        <nav class="absolute flex justify-evenly items-center w-[300px] h-[50px] top-[135px] left-1/2 -translate-x-1/2 bg-green4 rounded-[20px] border border-green1"> <!-- left-1/2 and top-1/2 = put corner high right center and -translate-x-1/2 -translate-y-1/2 = recenter -->
            <a class="font-second text-[16px] flex w-[200px] h-[55px] items-center justify-center flex-col" href="/"><img src="{{ asset('images/Accueil.svg') }}" alt="Logo Accueil">ACCUEIL</a>
            <a class="font-second text-[16px] flex w-[200px] h-[55px] items-center justify-center flex-col" href="/covoiturages"><img src="{{ asset('images/Covoiturages.svg') }}" alt="Logo Covoiturages">COVOITURAGES</a>
            <a class="font-second text-[16px] flex w-[200px] h-[55px] items-center justify-center flex-col" href="/connexion"><img src="{{ asset('images/Connexion.svg') }}" alt="Logo Connexion">CONNEXION</a>
            <a class="font-second text-[16px] flex w-[200px] h-[55px] items-center justify-center flex-col" href="/contact"><img src="{{ asset('images/Contact.svg') }}" alt="Logo Contact">CONTACT</a>
        </nav>

        <div class="bg-green4 w-full h-[10px]"></div>
        <div class="bg-green3 w-full h-[10px]"></div>
        <div class="bg-green2 w-full h-[10px]"></div>
        <div class="bg-green1 w-full h-[10px]"></div>

    </div>

</header>
