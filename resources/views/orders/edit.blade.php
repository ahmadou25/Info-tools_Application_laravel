@extends('orders.layout')

@section('content')
<div class="container">
    <h1>Modifier la Commande #{{ $order->order_id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order->order_id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" id="client_id" class="form-select" required>
                @foreach($clients as $client)
                    <option value="{{ $client->client_id }}" {{ $client->client_id == $order->client_id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="product_id" class="form-label">Produit</label>
            <select name="product_id" id="product_id" class="form-select" required>
                @foreach($products as $product)
                    <option value="{{ $product->product_id }}" {{ $product->product_id == $order->product_id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantité</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required min="1" value="{{ $order->quantity }}">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" required value="{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour la Commande</button>
    </form>
</div>
@endsection
