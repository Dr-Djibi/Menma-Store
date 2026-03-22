@extends('layouts.app')

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
    </div>
</div>
@endsection
