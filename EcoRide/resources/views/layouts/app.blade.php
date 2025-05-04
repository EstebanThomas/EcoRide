<!DOCTYPE html>
<html lang="fr">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title', 'Mon site Laravel')</title>
</head>
<body>

    @include('partials.header')

    <div class="content">
        @yield('content')
    </div>

    <footer>
    @include('partials.footer')
    </footer>

</body>
</html>