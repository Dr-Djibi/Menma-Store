@extends('layouts.admin')

@section('content')
<div class="edit-container">
    <h2>💬 Gestion des Avis Clients</h2>

    <div class="admin-card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr class="table-head">
                        <th>Client</th>
                        <th>Produit</th>
                        <th>Note</th>
                        <th>Commentaire</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->nom_client }}</td>
                        <td>{{ $comment->product->nom ?? 'Produit inconnu' }}</td>
                        <td>{{ $comment->note }}/5</td>
                        <td>{{ $comment->texte }}</td>
                        <td>{{ $comment->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
