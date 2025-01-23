@extends('orders.layout')

@section('content')
<div class="container mx-auto p-6 bg-gray-50 rounded shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Créer une Commande</h1>

    @if($errors->any())
        <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Sélection du Client -->
        <div class="mb-4">
            <label for="id" class="block text-lg font-medium mb-2">Client</label>
            <select name="id" id="id" class="form-select w-full border border-gray-300 p-2 rounded" required>
                <option value="">Sélectionner un Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">
                        {{ $client->first_name ?? 'Nom Inconnu' }} {{ $client->last_name ?? 'Prénom Inconnu' }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Section pour ajouter plusieurs produits -->
        <div id="products-container" class="space-y-4">
            <div class="product-row flex items-center space-x-4">
                <div class="w-full">
                    <label for="product_id" class="block text-lg font-medium mb-2">Produit</label>
                    <select name="products[0][product_id]" class="form-select w-full border border-gray-300 p-2 rounded mb-2" required>
                        <option value="">Sélectionner un Produit</option>
                        @foreach($products as $product)
                            <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>

                    <label for="quantity" class="block text-lg font-medium mb-2">Quantité</label>
                    <input type="number" name="products[0][quantity]" class="form-control w-full border border-gray-300 p-2 rounded" required min="1">
                </div>
                <!-- Bouton Supprimer -->
                <button type="button" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded remove-product">
                    Supprimer
                </button>
            </div>
        </div>

        <!-- Date de la commande -->
        <div class="mb-4">
            <label for="date" class="block text-lg font-medium mb-2">Date</label>
            <input type="date" name="date" id="date" class="form-control w-full border border-gray-300 p-2 rounded" required>
        </div>

        <!-- Boutons -->
        <div class="flex justify-end space-x-4">
            <button type="button" id="add-product" class="btn btn-secondary bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded">
                Ajouter un Produit
            </button>
            <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                Créer la Commande
            </button>
        </div>
    </form>

    <!-- Bouton retour -->
    <div class="mt-6">
        <a href="{{ route('orders.index') }}" class="btn bg-gray-500 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">
            Retour à la Liste des Commandes
        </a>
    </div>
</div>

<!-- Script pour ajouter dynamiquement des produits -->
<script>
    let productIndex = 1;

    document.getElementById('add-product').addEventListener('click', function () {
        const container = document.getElementById('products-container');
        const newRow = document.createElement('div');
        newRow.classList.add('product-row', 'flex', 'items-center', 'space-x-4');
        newRow.innerHTML = `
            <div class="w-full">
                <label for="product_id" class="block text-lg font-medium">Produit</label>
                <select name="products[${productIndex}][product_id]" class="form-select w-full border border-gray-300 p-2 rounded mb-2" required>
                    <option value="">Sélectionner un Produit</option>
                    @foreach($products as $product)
                        <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                    @endforeach
                </select>

                <label for="quantity" class="block text-lg font-medium">Quantité</label>
                <input type="number" name="products[${productIndex}][quantity]" class="form-control w-full border border-gray-300 p-2 rounded" required min="1">
            </div>
            <button type="button" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded remove-product">
                Supprimer
            </button>
        `;
        container.appendChild(newRow);
        productIndex++;
    });

    // Supprimer une ligne de produit
    document.getElementById('products-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-product')) {
            e.target.parentElement.remove();
        }
    });
</script>
@endsection
