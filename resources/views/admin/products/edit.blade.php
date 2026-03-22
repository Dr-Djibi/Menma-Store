@extends('layouts.admin')

@section('content')
<div class="edit-container">
    <h2>✏️ Modifier le Produit</h2>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nom du produit</label>
            <input type="text" name="nom" value="{{ $product->nom }}" required>
        </div>

        <div class="form-group-row">
            <div>
                <label>Prix (FGn)</label>
                <input type="number" step="1" name="prix" value="{{ $product->prix }}" required>
            </div>
            <div>
                <label>Quantité en Stock</label>
                <input type="number" name="stock" value="{{ $product->stock }}" required>
            </div>
        </div>

        <div class="form-group">
            <label>Description détaillée</label>
            <textarea name="description" rows="5">{{ $product->description }}</textarea>
        </div>

        <div class="media-section">
            <h3>🖼️ Galerie de Photos (URLs)</h3>
            <div class="image-inputs-grid">
                <div class="form-group">
                    <label>Image Principale (Obligatoire)</label>
                    <input type="text" name="image_url" id="image_url" value="{{ $product->image_url }}" required oninput="updatePreview(this, 'preview_main')">
                    <div class="mt-10">
                        <img id="preview_main" src="{{ $product->image_url }}" style="max-width: 150px; border-radius: 8px; border: 1px solid #ddd; display: {{ $product->image_url ? 'block' : 'none' }};">
                    </div>
                </div>
                <div class="form-group-row">
                    <div><label>Image 2</label><input type="text" name="image_url2" value="{{ $product->image_url2 }}"></div>
                    <div><label>Image 3</label><input type="text" name="image_url3" value="{{ $product->image_url3 }}"></div>
                </div>
                <div class="form-group-row">
                    <div><label>Image 4</label><input type="text" name="image_url4" value="{{ $product->image_url4 }}"></div>
                    <div><label>Image 5</label><input type="text" name="image_url5" value="{{ $product->image_url5 }}"></div>
                </div>
            </div>
            <div class="form-group mt-15">
                <label class="text-danger">Lien Vidéo</label>
                <input type="text" name="video_url" value="{{ $product->video_url }}" placeholder="YouTube URL">
            </div>
        </div>

        <div class="actions-row">
            <button type="submit" class="btn-save flex-2">ENREGISTRER LES MODIFICATIONS</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel flex-1">ANNULER</a>
        </div>
    </form>
</div>
@endsection
