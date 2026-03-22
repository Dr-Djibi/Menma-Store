<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings['shop_name'] ?? 'Menma Shop')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="{{ $settings['pwa_theme_color'] ?? '#2c3e50' }}">
    <link rel="apple-touch-icon" href="{{ $settings['pwa_icon'] ?? asset('assets/img/icon-512.png') }}">
    @yield('styles')
</head>
<body>
    <header class="main-header">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="logo">
                @if(!empty($settings['shop_logo']))
                    <img src="{{ $settings['shop_logo'] }}" alt="{{ $settings['shop_name'] }}" style="max-height: 40px; display: inline-block; vertical-align: middle;">
                @else
                    {{ $settings['shop_name'] ?? 'Menma Shop' }} <span>Shop</span>
                @endif
            </a>
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
    </footer>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
    @yield('scripts')
</body>
</html>
