@extends('orders.layout')

@section('content')
<div class="container">
    <h1>Liste des Commandes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('orders.index') }}" method="GET" class="mb-4">
        <label for="client_id">Filtrer par Client:</label>
        <select name="client_id" id="client_id" class="form-select">
            <option value="">Tous les Clients</option>
            @foreach($clients as $client)
                <option value="{{ $client->client_id }}">{{ $client->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Filtrer</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Date</th>
                <th>Montant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->client->name }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}</td>
                    <td>{{ number_format($order->amount, 2) }} €</td>
                    <td>
                        <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('orders.edit', $order->order_id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('orders.create') }}" class="btn btn-success">Ajouter une Commande</a>
</div>
@endsection
