@extends('layouts.admin')

@section('content')
<div class="edit-container">
    <div class="dashboard-header">
        <h2>Tableau de Bord</h2>
        <a href="{{ route('admin.products.create') }}" class="btn-save btn-new-product">
            <i class="fas fa-plus"></i> Nouveau Produit
        </a>
    </div>

    <div class="stats-grid mt-20">
        <div class="stat-card">
            <h4 class="stat-title">Produits</h4>
            <p class="stat-value">{{ $totalProducts }}</p>
        </div>
        <div class="stat-card">
            <h4 class="stat-title">Commandes</h4>
            <p class="stat-value">{{ $totalOrders }}</p>
        </div>
        <div class="stat-card">
            <h4 class="stat-title">Commentaires</h4>
            <p class="stat-value">{{ $totalComments }}</p>
        </div>
        <div class="stat-card">
            <h4 class="stat-title">Chiffre d'affaires</h4>
            <p class="stat-value stat-green">{{ number_format($revenue, 0) }} FGn</p>
        </div>
    </div>

    <div class="admin-card">
        <h3><i class="fas fa-boxes"></i> Stocks</h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr class="table-head">
                        <th>Nom</th>
                        <th class="text-center">Prix</th>
                        <th class="text-center">Stock</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $prod)
                    <tr>
                        <td><strong>{{ $prod->nom }}</strong></td>
                        <td class="price"><strong>{{ number_format($prod->prix, 0) }} FGn</strong></td>
                        <td class="text-center">{{ $prod->stock }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn-edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" style="background:none; border:none; color:inherit; cursor:pointer;"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="admin-card mt-40">
        <h3><i class="fas fa-truck"></i> Commandes</h3>
        <div class="card-toolbar">
            <a href="{{ route('admin.orders.index') }}" class="btn-save btn-new-product">
                <i class="fas fa-arrow-right"></i> Ouvrir les commandes
            </a>
        </div>
        <p>Voir et gérer toutes les commandes dans une page dédiée.</p>
    </div>
</div>
@endsection
