@extends('layouts.app')

@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator $products */
    /** @var array $settings */
@endphp

@section('content')
<div class="hero-section">
    <h1>{{ $settings['hero_title'] ?? 'LIVRAISON GRATUITE' }}</h1>
    <p>{{ $settings['hero_subtitle'] ?? 'Commandez sur WhatsApp • Payez à la livraison' }}</p>
</div>

<div class="container">
    <div class="product-grid" id="products">
        @foreach($products as $p)
            <div class="product-card">
                <div class="product-image">
                    @if(!empty($p->image_url))
                        <img src="{{ $p->image_url }}" alt="{{ $p->nom }}">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Pas+d'image" alt="Image indisponible">
                    @endif
                    
                    @if ($p->stock <= 0)
                        <span class="badge-soldout">Rupture</span>
                    @endif
                </div>
                
                <div class="product-content">
                    <h3>{{ $p->nom }}</h3>
                    <p class="product-price">{{ number_format($p->prix, 0) }} FGn</p>
                    <p class="shipping-info">✅ {{ $settings['hero_title'] ?? 'LIVRAISON GRATUITE' }}</p>
                    
                    <div class="product-footer">
                        <a href="{{ route('product.show', $p->id) }}" class="btn-view"><i class="fas fa-shopping-bag"></i> Commander</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $products->links() }}
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Contactez-nous</h2>
                    <p>Une question ? Une commande spéciale ? Notre équipe est disponible 7j/7 pour vous accompagner.</p>
                    
                    <div class="whatsapp-contact-card">
                        <div class="whatsapp-pulse">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h3>Service Client WhatsApp</h3>
                        <p>Réponse en moins de 10 minutes</p>
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '224625968097' }}" target="_blank" class="btn-whatsapp" style="display: block; text-decoration: none; color: white;">
                            DISCUTER MAINTENANT
                        </a>
                    </div>
                </div>

                <div class="contact-form-card">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label>Nom complet</label>
                            <input type="text" placeholder="Votre nom..." required>
                        </div>
                        <div class="form-group">
                            <label>Numéro de téléphone</label>
                            <input type="tel" placeholder="Ex: 622 00 00 00" required>
                        </div>
                        <div class="form-group">
                            <label>Votre message</label>
                            <textarea rows="4" placeholder="Comment pouvons-nous vous aider ?" required></textarea>
                        </div>
                        <button type="submit" class="btn-send">ENVOYER LE MESSAGE</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
