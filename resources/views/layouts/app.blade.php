<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings['shop_name'] ?? 'Menma Shop')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('styles')
</head>
<body>
    <header class="main-header">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="logo">{{ $settings['shop_name'] ?? 'Menma Shop' }} <span>Shop</span></a>
            <button class="nav-toggle" id="navToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav class="main-nav" id="mainNav">
                <ul>
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a></li>
                    <li><a href="#products">Produits</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date("Y") }} - {{ $settings['shop_name'] ?? 'Menma Shop' }} - Tous droits réservés</p>
    </footer>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
    @yield('scripts')
</body>
</html>
