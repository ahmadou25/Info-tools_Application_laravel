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

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Retour à la Liste</a>
    <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning">Modifier la Commande</a>
    <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer la Commande</button>
    </form>
</div>
@endsection
