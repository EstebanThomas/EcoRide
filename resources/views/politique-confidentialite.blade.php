@extends('layouts.app')

@section('content')

    <div class="flex flex-col justify-center items-center mt-75 xl:mt-5 gap-10 bg-green4 rounded-3xl p-5 m-5 xl:ml-25 xl:mr-25">

        <h1 class="font-main text-6xl text-green1 uppercase text-shadow-lg">
            Politique de confidentialité
        </h1>

        <div class="flex flex-col justify-center items-center gap-2">
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                Date : 12/05/2025<br>
                La présente politique de confidentialité a pour objectif d’informer les utilisateurs du site EcoRide, 
                des modalités de traitement de leurs données personnelles conformément au Règlement Général sur la Protection des Données (RGPD) et à la loi française.
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Identité du responsable de traitement
            </h1>
            <p class="font-second text-4xl text-black text-center">
                Le responsable du traitement est :<br>
                - Nom Prénom : Thomas Estéban<br>
                - Adresse : France<br>
                - Adresse e-mail : <a href="/contact" class="hover:decoration-green1 hover:underline active:decoration-green2">ecoride.et@gmail.com</a>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Données personnelles collectées
            </h1>
            <p class="font-second text-4xl text-black text-center">
                Les données collectées sur le site peuvent inclure :<br>
                - Nom, prénom<br>
                - Adresse e-mail<br>
                - Numéro de téléphone<br>
                - mot de passe (chiffré)<br>
                - Informations de covoiturage (lieux, dates, préférences, véhicules)<br>
                - Avis et commentaires<br>
                - Données de navigation et cookies<br>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Finalités du traitement
            </h1>
            <p class="font-second text-4xl text-black text-center">
                Les données collectées sont utilisées pour :<br>
                - La création et la gestion de comptes utilisateurs<br>
                - La mise en relation entre covoitureurs<br>
                - L’organisation et la gestion des trajets<br>
                - L’envoi de notifications ou d’e-mails de service<br>
                - L’amélioration du service et du site (analyse de trafic, retours utilisateurs)<br>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Base légale du traitement
            </h1>
            <p class="font-second text-4xl text-black text-center">
                Les traitements de données sont fondés sur :<br>
                - L’exécution d’un contrat (inscription et gestion du compte)<br>
                - Le consentement (dépôt de cookies)<br>
                - L’intérêt légitime (sécurité du site, lutte contre les fraudes)<br>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">                       <!--WARNING !!! TIME BEFORE EXPIRATION COOKIES-->
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Durée de conservation des données
            </h1>
            <p class="font-second text-4xl text-black text-center">
                Les données sont conservées :<br>
                - 3 ans après la dernière activité sur le compte<br>
                - 1 an pour les données de navigation (cookies)<br>
                - 6 mois pour les logs de connexion à des fins de sécurité<br>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Destinataires des données
            </h1>
            <p class="font-second text-4xl text-black text-center">
                Les données peuvent être partagées uniquement avec :<br>
                - Les prestataires techniques nécessaires au fonctionnement du site (hébergeur, e-mailing, analyse)<br>
                - Les autorités compétentes dans le cadre d’obligations légales<br>
                Aucune donnée personnelle n’est vendue à des tiers.<br>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Transfert hors Union européenne
            </h1>
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                Certaines données peuvent être traitées en dehors de l’Union européenne (ex. : hébergement sur Vercel). 
                Dans ce cas, nous veillons à ce que les garanties appropriées soient en place (clauses contractuelles types de la Commission européenne ou équivalent).
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Vos droits
            </h1>
            <p class="font-second text-4xl text-black text-center">
                Conformément au RGPD, vous disposez des droits suivants :<br>
                - Droit d’accès, de rectification, de suppression de vos données<br>
                - Droit à la portabilité<br>
                - Droit d’opposition ou de limitation du traitement<br>
                - Droit de retirer votre consentement à tout moment<br>
                - Droit d’introduire une réclamation auprès de la CNIL<br>
                Vous pouvez exercer ces droits en nous contactant à : <a href="/contact" class="hover:decoration-green1 hover:underline active:decoration-green2">ecoride.et@gmail.com</a>
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Cookies
            </h1>
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                EcoRide utilise des cookies pour :<br>
                - Améliorer votre navigation<br>
                - Analyser l’audience du site<br>
                - Mémoriser vos préférences<br>
                Vous pouvez gérer vos préférences via le bandeau cookie prévu à cet effet ou via les paramètres de votre navigateur. 
                Pour plus d'informations, consultez notre politique de cookies.
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Sécurité
            </h1>
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                Nous mettons en œuvre des mesures techniques et organisationnelles appropriées pour garantir la sécurité 
                de vos données personnelles (chiffrement des mots de passe, HTTPS, journalisation des accès, etc.).
            </p>
        </div>

        <div class="flex flex-col justify-center items-center gap-2">
            <h1 class="font-second text-5xl text-green1 uppercase text-shadow-lg">
                Modification de la politique
            </h1>
            <p class="font-second text-4xl text-black text-center pl-10 pr-10 xl:pl-75 xl:pr-75">
                EcoRide se réserve le droit de modifier la présente politique à tout moment. 
                En cas de modification substantielle, vous serez informé par e-mail ou notification sur le site.
            </p>
        </div>
    </div>
@endsection