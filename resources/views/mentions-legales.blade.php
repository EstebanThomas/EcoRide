@extends('layouts.app')

@section('content')

    <div class="flex flex-col justify-center items-center mt-75 xl:mt-5 gap-10 bg-green4 rounded-3xl p-5 m-5 xl:ml-25 xl:mr-25">

        <h1 class="font-main text-6xl text-green1 uppercase text-shadow-lg">
            Mentions légales
        </h1>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                éditeur du site
            </h1>
            <p class="font-second text-4xl text-black text-center">
                Le présent site est édité par :<br>
                Nom Prénom : Thomas Estéban<br>
                Adresse : France<br>
                Adresse e-mail : <a href="/contact" class="hover:decoration-green1 hover:underline active:decoration-green2">ecoride.et@gmail.com</a>
                Responsable de la publication : Thomas Estéban
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Hébergement du site
            </h1>
            <p class="font-second text-4xl text-black text-center">
                Le présent site est hébergé par :<br>
                Vercel Inc.<br>
                340 S Lemon Av #4133 - Walnut, CA 91789 - États-Unis<br>
                <a href="https://vercel.com" class="hover:decoration-green1 hover:underline active:decoration-green2">https://vercel.com</a>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Propriété intellectuelle
            </h1>
            <p class="font-second text-4xl text-black text-start pl-10 pr-10 xl:pl-75 xl:pr-75">
                Le contenu du site EcoRide (textes, images, logo, code source, etc.) est protégé par le droit de la propriété intellectuelle. 
                Toute reproduction ou diffusion sans autorisation écrite préalable est interdite.
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Données personnelles
            </h1>
            <p class="font-second text-4xl text-black text-start pl-10 pr-10 xl:pl-75 xl:pr-75">
                Des données personnelles peuvent être collectées dans le cadre de l’utilisation du site (inscription, mise en relation pour covoiturage, etc.).
                Conformément au Règlement Général sur la Protection des Données (RGPD), vous disposez des droits suivants :<br>
                - Droit d’accès, de rectification, de suppression<br>
                - Droit à la portabilité<br>
                - Droit d’opposition et de limitation du traitement<br>
                Pour toute demande, vous pouvez contacter : <a href="/contact" class="hover:decoration-green1 hover:underline active:decoration-green2">ecoride.et@gmail.com</a>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Cookies
            </h1>
            <p class="font-second text-4xl text-black text-start pl-10 pr-10 xl:pl-75 xl:pr-75">
                EcoRide utilise des cookies pour assurer le bon fonctionnement du site et collecter des statistiques anonymes.
                Un bandeau de gestion des cookies vous permet de les accepter ou de les refuser.
                Pour plus d’informations, consultez notre politique de confidentialité. <!--POLITIQUE DE CONFIDENTIALITE + BANDEAU COOKIES ?????-->
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Responsabilité
            </h1>
            <p class="font-second text-4xl text-black text-start pl-10 pr-10 xl:pl-75 xl:pr-75">
                L’éditeur du site s’efforce de fournir un service fiable, mais ne saurait être tenu responsable en cas d’erreurs, de dysfonctionnements techniques ou de contenu tiers.
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Droit applicable
            </h1>
            <p class="font-second text-4xl text-black text-start pl-10 pr-10 xl:pl-75 xl:pr-75">
                Les présentes mentions légales sont régies par le droit français. En cas de litige, seuls les tribunaux français seront compétents.
            </p>
        </div>
    </div>
@endsection