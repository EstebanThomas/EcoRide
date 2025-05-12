@extends('layouts.app')

@section('content')

    <div class="flex flex-col justify-center items-center mt-75 xl:mt-5 gap-10 bg-green4 rounded-3xl p-5 m-5 xl:ml-25 xl:mr-25">

        <h1 class="font-main text-6xl text-green1 uppercase text-shadow-lg">
            Politique des cookies
        </h1>
        <div class="flex flex-col justify-center items-center gap-2">
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                Date : 12/05/2025<br>
                Le site EcoRide utilise des cookies et autres traceurs afin de garantir une expérience optimale, 
                assurer certaines fonctionnalités et mesurer l’audience.
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Definition Cookie
            </h1>
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                Un cookie est un petit fichier texte déposé sur votre terminal (ordinateur, smartphone, tablette) 
                lorsque vous visitez un site internet. 
                Il permet notamment de stocker des informations sur votre navigation, afin de faciliter votre expérience et d’améliorer nos services.
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Les cookies utilisés
            </h1>
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                Voici les catégories de cookies que nous utilisons :<br>
                Cookies nécessaires
                - Fonctionnement du site (authentification, navigation, sécurité)<br>
                - Exemptés de consentement<br>
                Cookies de mesure d’audience (statistiques)
                - Permettent d’analyser la fréquentation et l’utilisation du site (pages visitées, durée de session, etc.)<br>
                - Outils possibles : Google Analytics, Plausible, etc.<br>
                - Consentement requis<br>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">                                                       <!--GERER LES COOKIE NEW PAGE + BANDERAU REQUIEREMENTS-->
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Consentement
            </h1>
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                Lors de votre première visite, un bandeau de consentement s’affiche. Vous avez la possibilité :<br>
                - D’accepter tous les cookies<br>
                - De les refuser<br>
                - De personnaliser vos choix<br>
                Vous pouvez modifier vos préférences à tout moment en cliquant sur <a href="/gererCookies" class="hover:decoration-green1 hover:underline active:decoration-green2">Gérer mes cookies</a> en bas de page.<br>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">                                                       <!--DUREE CONSERVATION COOKIES-->
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Durée de conservation des cookies
            </h1>
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                Les cookies sont conservés au maximum 13 mois après leur dépôt sur votre terminal. Au-delà, un nouveau consentement vous sera demandé.
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                gérer ou supprimer des cookies
            </h1>
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                Vous pouvez aussi configurer votre navigateur pour bloquer ou supprimer les cookies.
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Contact
            </h1>
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                Pour toute question sur cette politique ou le traitement de vos données personnelles, 
                vous pouvez nous contacter à l’adresse suivante : <a href="/contact" class="hover:decoration-green1 hover:underline active:decoration-green2">ecoride.et@gmail.com</a>
            </p>
        </div>
    </div>
@endsection