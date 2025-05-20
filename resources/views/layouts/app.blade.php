<!DOCTYPE html>

<html lang="fr">

    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>@yield('title', 'EcoRide')</title>
        <link rel="icon" type="image/png" href="{{ asset('Images/EcoRide_Logo_WiBg.png') }}">
    </head>

    <body>

        @include('partials.header')

        <x-cookie-banner/>

        <div class="content">
            @yield('content')
        </div>

        <footer>
        @include('partials.footer')
        </footer>

    </body>

</html>