@extends('layouts.admin')

@section('content')
<div class="edit-container">
    <h2>📦 Gestion des Commandes</h2>

    <div class="admin-card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr class="table-head">
                        <th>ID</th>
                        <th>Client</th>
                        <th>Produit</th>
                        <th>Adresse</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->nom_client }}</td>
                        <td>{{ $order->product->nom ?? 'Produit inconnu' }}</td>
                        <td>{{ $order->adresse_livraison }}</td>
                        <td>
                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="statut_livraison" onchange="this.form.submit()">
                                    <option value="en attente" {{ $order->statut_livraison == 'en attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="livré" {{ $order->statut_livraison == 'livré' ? 'selected' : '' }}>Livré</option>
                                    <option value="annulé" {{ $order->statut_livraison == 'annulé' ? 'selected' : '' }}>Annulé</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
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
</div>
@endsection
