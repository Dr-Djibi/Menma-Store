@extends('layouts.app')

@php
    /** @var \App\Models\Product $product */
    /** @var array $settings */
@endphp

@section('content')
<div class="container">
    <div class="product-detail-layout">
        <div class="product-visuals">
            <div id="main-display" class="main-image">
                <img src="{{ $product->image_url }}" id="view-target" class="main-img">
            </div>

            <div class="thumb-list">
                @php
                    $images = [$product->image_url, $product->image_url2, $product->image_url3, $product->image_url4, $product->image_url5];
                @endphp
                @foreach($images as $img)
                    @if(!empty($img))
                        <img src="{{ $img }}" onclick="updateView(this.src)" class="thumb-item">
                    @endif
                @endforeach
            </div>
        </div>

        <div class="product-info">
            <span class="badge-shipping">{{ $settings['hero_title'] ?? 'LIVRAISON GRATUITE' }}</span>
            <h1 class="product-title">{{ $product->nom }}</h1>
            <p class="price-big">{{ number_format($product->prix, 0, ',', ' ') }} FGn</p>
            
            <div class="product-details">
                <h3>Détails du produit</h3>
                <p>{!! nl2br(e($product->description)) !!}</p>
            </div>

            <div class="order-box">
                <h3>Commander ce produit</h3>
                
                <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="form-group">
                        <label for="nom_client">Nom complet</label>
                        <input type="text" name="nom_client" id="nom_client" placeholder="Ex: Mamadou Diallo" required>
                    </div>

                    <div class="form-group">
                        <label for="adresse_livraison">Adresse de livraison</label>
                        <input type="text" name="adresse_livraison" id="adresse_livraison" placeholder="Ville / Quartier" required>
                    </div>
                    
                    <button type="submit" class="btn-whatsapp">
                         🛒 CONFIRMER LA COMMANDE
                    </button>
                </form>
                <p class="order-note">Paiement Cash à la livraison. Une fenêtre WhatsApp s'ouvrira après confirmation.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function updateView(src) {
        document.getElementById('view-target').src = src;
    }

    document.getElementById('orderForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nom = document.getElementById('nom_client').value;
        const adresse = document.getElementById('adresse_livraison').value;
        const produit = "{{ addslashes($product->nom) }}";
        const prix = "{{ number_format($product->prix, 0, ',', ' ') }} FGn";
        const whatsappNumber = "{{ $settings['whatsapp_number'] ?? '224625968097' }}";
        const shippingText = "{{ $settings['hero_title'] ?? 'LIVRAISON GRATUITE' }}";

        const message = `Bonjour Menma Shop ! Je commande :
📦 *Produit :* ${produit}
💰 *Prix :* ${prix}
🚚 *Livraison :* ${shippingText}
--------------------------
👤 *Client :* ${nom}
📍 *Adresse :* ${adresse}
--------------------------
_Je paierai à la réception._`;

        const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');

        // Envoyer les données au serveur Laravel
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        }).then(response => response.json())
          .then(data => {
              alert("Commande confirmée !");
          });
    });
</script>
@endsection
