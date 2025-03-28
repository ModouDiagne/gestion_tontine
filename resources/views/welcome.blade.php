<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion de Tontine</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <div class="info-section">
        <h2>Pourquoi choisir notre plateforme ?</h2>
        <p>Gérez vos tontines en toute sécurité, avec des transactions transparentes et un suivi en temps réel.</p>
    </div>
    <div class="stats">
        <p><i class="fas fa-users"></i> Déjà <strong>{{ $usersCount ?? '500+' }}</strong> utilisateurs inscrits !</p>
        <p><i class="fas fa-handshake"></i> <strong>{{ $tontinesCount ?? '150+' }}</strong> tontines créées.</p>
    </div>

    <div class="overlay">
        <h1>Bienvenue sur Gestion de Tontine</h1>
        <p>Gérez vos tontines en toute simplicité et sécurité avec notre plateforme.</p>

        @if (\Illuminate\Support\Facades\Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="btn btn-primary"><i class="fas fa-tachometer-alt"></i> Accéder au Dashboard</a>            @else
                <a href="{{ route('login') }}" class="btn btn-secondary">Se Connecter</a>
                @if (\Illuminate\Support\Facades\Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">S'inscrire</a>
                @endif
            @endauth
        @endif

        <br>
        <a href="{{ route('tontines.index') }}" class="btn btn-secondary"><i class="fas fa-piggy-bank"></i> Voir les Tontines</a>
    </div>
    <blockquote class="quote">
        "Seul, on va plus vite ; ensemble, on va plus loin." – Proverbe Africain
    </blockquote>

</body>
</html>
