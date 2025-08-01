<!DOCTYPE html>

<html lang="fr">

    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>@yield('title', 'EcoRide')</title>
        <link rel="icon" type="image/png" href="{{ asset('Images/EcoRide_Logo_WiBg.png') }}">
    </head>

    <body  class="flex flex-col min-h-screen">

        @include('partials.header')

        <x-cookie-banner/>

        <main class="content flex-grow">
            @yield('content')
        </main>

        <footer class="w-full">
        @include('partials.footer')
        </footer>

    </body>

</html>