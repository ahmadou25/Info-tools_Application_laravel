@extends('orders.layout')

@section('content')
<div class="container">
    <h1>Créer une Commande</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" id="client_id" class="form-select" required>
                <option value="">Sélectionner un Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->client_id }}">{{ $client->first_name ?? 'Nom Inconnu' }} {{ $client->last_name ?? 'Prénom Inconnu' }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="product_id" class="form-label">Produit</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <option value="">Sélectionner un Produit</option>
                @foreach($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantité</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer la Commande</button>
    </form>
</div>
@endsection
