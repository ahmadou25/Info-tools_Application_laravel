@extends('orders.layout')

@section('content')
<div class="container">
    <h1>Détails de la Commande #{{ $order->order_id }}</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>Client:</strong> {{ $order->client->name }}</li>
        <li class="list-group-item"><strong>Produit:</strong> {{ $order->product->name }}</li>
        <li class="list-group-item"><strong>Quantité:</strong> {{ $order->quantity }}</li>
        <li class="list-group-item"><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}</li>
        <li class="list-group-item"><strong>Montant:</strong> {{ number_format($order->amount, 2) }} €</li>
    </ul>

    <!-- Bouton Retour à la Liste en bleu -->
    <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3">Retour à la Liste</a>

    <!-- Afficher le bouton Modifier uniquement si l'utilisateur a la permission -->
    @can('update', $order)
        <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning">Modifier la Commande</a>
    @endcan

    <!-- Afficher le bouton Supprimer uniquement si l'utilisateur a la permission -->
    @can('delete', $order)
        <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">Supprimer la Commande</button>
        </form>
    @endcan
</div>
@endsection
