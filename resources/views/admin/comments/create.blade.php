@extends('layouts.admin')

@section('content')
<div class="edit-container">
    <h2 class="card-title">⭐ Ajouter un avis client</h2>
    <p class="muted">Utilisez ce formulaire pour ajouter manuellement des témoignages sur vos produits.</p>

    <form action="{{ route('admin.comments.store') }}" method="POST" class="admin-form">
        @csrf
        <div class="form-row">
            <div>
                <label>Sélectionner le produit</label>
                <select name="product_id" required>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Note (1 à 5 étoiles)</label>
                <select name="note" required>
                    <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                    <option value="4">⭐⭐⭐⭐ (Très bien)</option>
                    <option value="3">⭐⭐⭐ (Moyen)</option>
                    <option value="2">⭐⭐ (Bof)</option>
                    <option value="1">⭐ (Mauvais)</option>
                </select>
            </div>
        </div>

        <div class="form-group mt-15">
            <label>Nom du client</label>
            <input type="text" name="nom_client" placeholder="Ex: Moussa B." required>
        </div>

        <div class="form-group mt-15">
            <label>Commentaire / Avis</label>
            <textarea name="texte" rows="4" placeholder="Ex: Produit de très bonne qualité, je recommande !" required></textarea>
        </div>

        <div class="actions-row mt-20">
            <button type="submit" class="btn-save btn-warning">PUBLIER L'AVIS</button>
            <a href="{{ route('admin.comments.index') }}" class="btn-cancel">ANNULER</a>
        </div>
    </form>
</div>
@endsection
