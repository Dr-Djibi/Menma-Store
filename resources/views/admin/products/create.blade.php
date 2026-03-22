@extends('layouts.admin')

@php
    /** @var array $settings */
@endphp

@section('content')
<div class="edit-container">
    <h2>➕ Ajouter un Nouveau Produit</h2>
    <form action="{{ route('admin.products.store') }}" method="POST" class="admin-form">
        @csrf
        <div class="form-group">
            <label>Nom du produit</label>
            <input type="text" name="nom" placeholder="Ex: iPhone 15 Pro Max" required>
        </div>

        <div class="form-group-row">
            <div>
                <label>Prix (FGn)</label>
                <input type="number" step="1" name="prix" placeholder="0" required>
            </div>
            <div>
                <label>Quantité en Stock</label>
                <input type="number" name="stock" value="10" required>
            </div>
        </div>

        <div class="form-group">
            <label>Description détaillée</label>
            <textarea name="description" rows="5" placeholder="Décrivez les caractéristiques du produit..."></textarea>
        </div>

        <div class="media-section">
            <h3>🖼️ Galerie de Photos (URLs)</h3>
            <div class="image-inputs-grid">
                <div class="form-group">
                    <label>Image Principale (Obligatoire)</label>
                    <input type="text" name="image_url" placeholder="https://lien-image-1.jpg" required>
                </div>
                <div class="form-group-row">
                    <div><label>Image 2</label><input type="text" name="image_url2"></div>
                    <div><label>Image 3</label><input type="text" name="image_url3"></div>
                </div>
                <div class="form-group-row">
                    <div><label>Image 4</label><input type="text" name="image_url4"></div>
                    <div><label>Image 5</label><input type="text" name="image_url5"></div>
                </div>
            </div>
            <div class="form-group mt-15">
                <label class="text-danger">Lien Vidéo</label>
                <input type="text" name="video_url" placeholder="YouTube URL">
            </div>
        </div>

        <div class="actions-row">
            <button type="submit" class="btn-save flex-2">PUBLIER LE PRODUIT</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel flex-1">ANNULER</a>
        </div>
    </form>
</div>
@endsection
