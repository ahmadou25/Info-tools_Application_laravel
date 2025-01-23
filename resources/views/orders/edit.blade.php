@extends('orders.layout')

@section('content')
<div class="container mx-auto p-6 bg-gray-50 rounded shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Modifier la Commande #{{ $order->order_id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger bg-red-500 text-white p-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order->order_id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')
        
        <!-- Sélection du Client -->
        <div class="mb-4">
            <label for="id" class="form-label block text-gray-700">Client</label>
            <select name="id" id="id" class="form-select w-full p-3 border rounded" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $order->id ? 'selected' : '' }}>
                        {{ $client->first_name }} {{ $client->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Section pour ajouter plusieurs produits -->
        <div id="products-container">
            @foreach($order->products as $index => $product)
                <div class="mb-4 product-row flex items-center gap-4">
                    <div class="flex-grow">
                        <label for="product_id" class="form-label block text-gray-700">Produit</label>
                        <select name="products[{{ $index }}][product_id]" class="form-select w-full p-3 border rounded" required>
                            @foreach($products as $prod)
                                <option value="{{ $prod->product_id }}" {{ $prod->product_id == $product->product_id ? 'selected' : '' }}>
                                    {{ $prod->name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity" class="form-label mt-2 block text-gray-700">Quantité</label>
                        <input type="number" name="products[{{ $index }}][quantity]" class="form-control w-full p-3 border rounded" required min="1" value="{{ $product->pivot->quantity }}">
                    </div>

                    <!-- Bouton de suppression -->
                    <button type="button" class="btn-remove-product bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded self-end">
                        Supprimer
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Bouton pour ajouter un produit -->
        <button type="button" id="add-product" class="btn bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded mt-4">Ajouter un Produit</button>

        <!-- Date -->
        <div class="mb-4 mt-6">
            <label for="date" class="form-label block text-gray-700">Date</label>
            <input type="date" name="date" id="date" class="form-control w-full p-3 border rounded" required value="{{ \Carbon\Carbon::parse($order->date)->format('Y-m-d') }}">
        </div>

        <!-- Boutons -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('orders.index') }}" class="btn bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                Retour à la Liste
            </a>
            
            <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded">
                Mettre à jour la Commande
            </button>
        </div>
    </form>
</div>

<!-- Script pour ajouter/supprimer dynamiquement des produits -->
<script>
    let productIndex = {{ count($order->products) }};  // Commence après les produits existants

    // Ajouter un produit
    document.getElementById('add-product').addEventListener('click', function () {
        const container = document.getElementById('products-container');
        const newRow = document.createElement('div');
        newRow.classList.add('mb-4', 'product-row', 'flex', 'items-center', 'gap-4');
        newRow.innerHTML = `
            <div class="flex-grow">
                <label for="product_id" class="form-label block text-gray-700">Produit</label>
                <select name="products[${productIndex}][product_id]" class="form-select w-full p-3 border rounded" required>
                    @foreach($products as $prod)
                        <option value="{{ $prod->product_id }}">{{ $prod->name }}</option>
                    @endforeach
                </select>

                <label for="quantity" class="form-label mt-2 block text-gray-700">Quantité</label>
                <input type="number" name="products[${productIndex}][quantity]" class="form-control w-full p-3 border rounded" required min="1">
            </div>

            <button type="button" class="btn-remove-product bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded self-end">
                Supprimer
            </button>
        `;
        container.appendChild(newRow);

        productIndex++;
    });

    // Supprimer un produit
    document.getElementById('products-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove-product')) {
            const productRow = e.target.closest('.product-row');
            productRow.remove();
        }
    });
</script>
@endsection
