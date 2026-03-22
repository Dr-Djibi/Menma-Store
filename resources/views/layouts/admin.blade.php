<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Administration | Store')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin-responsive.css') }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="{{ $settings['admin_theme_color'] ?? '#2b6cb0' }}">
    <link rel="apple-touch-icon" href="{{ $settings['pwa_icon'] ?? asset('assets/img/icon-512.png') }}">
    @yield('styles')
</head>
<body>
@include('components.flash-messages')

<nav class="nav-admin">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        @if(!empty($settings['shop_logo']))
            <img src="{{ $settings['shop_logo'] }}" alt="Logo" style="max-height: 35px; vertical-align: middle;">
        @else
            {{ $settings['admin_app_name'] ?? 'STORE ADMIN' }}<span>ADMIN</span>
        @endif
    </a>
    
    <button class="menu-toggle" id="menuToggle" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
    
    <div class="menu-admin" id="menuAdmin">
        <div class="user-info">
            <span><i class="fas fa-user-circle"></i> {{ auth()->user()->name ?? 'Admin' }}</span>
            <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn" style="background:none; border:none; color:inherit; cursor:pointer;"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
            </form>
        </div>

        <a href="{{ route('admin.dashboard') }}" title="Liste des produits"><i class="fas fa-th-list"></i> <span>Produits</span></a>
        <a href="{{ route('admin.products.create') }}" title="Ajouter un produit"><i class="fas fa-plus-circle"></i> <span>Ajouter</span></a>
        <a href="{{ route('admin.orders.index') }}" title="Commandes"><i class="fas fa-truck"></i> <span>Commandes</span></a>
        <a href="{{ route('admin.settings') }}" title="Réglages"><i class="fas fa-cog"></i> <span>Réglages</span></a>
        
        <div class="nav-actions">
            <a href="{{ route('home') }}" target="_blank" title="Voir le site public" class="btn-public">
                <i class="fas fa-external-link-alt"></i> <span>Voir le site</span>
            </a>
            <button id="copyLinkBtn" class="btn-copy-link" title="Copier le lien du site">
                <i class="fas fa-copy"></i> <span>Copier lien</span>
            </button>
        </div>
    </div>
</nav>

<div class="admin-wrapper">
    <main class="admin-content">
        @yield('content')
    </main>
</div>

<footer>
    <p>&copy; {{ date("Y") }} - Menma Shop - Tous droits réservés - By Menma (v4.0)</p>
</footer>

<script src="{{ asset('assets/js/admin-utils.js') }}"></script>
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js');
        });
    }
</script>
@yield('scripts')
<script>
    document.addEventListener('DOMContentLoaded',function(){
        const t=document.getElementById('menuToggle'),m=document.getElementById('menuAdmin');
        if(t&&m){
            t.addEventListener('click',e=>{
                e.stopPropagation(),t.classList.toggle('active'),m.classList.toggle('active')
            });
            document.addEventListener('click',e=>{
                !t.contains(e.target)&&!m.contains(e.target)&&(t.classList.remove('active'),m.classList.remove('active'))
            })
        }
    });
</script>
</body>
</html>
