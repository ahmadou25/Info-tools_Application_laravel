@extends('orders.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">

    <!-- Bande bleue en haut -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 rounded-t-xl shadow-md max-w-5xl mx-auto">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-white">Créer une Commande</h2>
            <a href="{{ route('orders.index') }}" class="flex items-center text-blue-200 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Retour aux commandes
            </a>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="max-w-5xl mx-auto p-8 bg-white rounded-b-xl shadow-md">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Créer une Commande</h1>

        @if($errors->any())
            <div class="bg-red-50 border border-red-400 text-red-700 px-6 py-4 rounded mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Client -->
            <div>
                <label for="id" class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                <select name="id" id="id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 text-sm" required>
                    <option value="">Sélectionner un Client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->first_name ?? 'Nom Inconnu' }} {{ $client->last_name ?? 'Prénom Inconnu' }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Produits -->
            <div id="products-container" class="space-y-6">
                <div class="product-row flex flex-col md:flex-row md:items-center md:space-x-6 space-y-4 md:space-y-0">
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Produit</label>
                        <select name="products[0][product_id]" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 text-sm" required>
                            <option value="">Sélectionner un Produit</option>
                            @foreach($products as $product)
                                <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantité</label>
                        <input type="number" name="products[0][quantity]" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 text-sm" required min="1">
                    </div>
                    <button type="button" class="mt-2 md:mt-6 bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded remove-product">
                        Supprimer
                    </button>
                </div>
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input type="date" name="date" id="date" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 text-sm" required>
            </div>

            <!-- Boutons -->
            <div class="flex justify-between items-center">
                <button type="button" id="add-product" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium px-4 py-2 rounded-md shadow-sm transition">
                    + Ajouter un Produit
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-md shadow-md transition">
                    Créer la Commande
                </button>
            </div>
        </form>

        <!-- Retour -->
        <div class="mt-8 text-center">
            <a href="{{ route('orders.index') }}" class="inline-block text-white bg-gray-500 hover:bg-gray-700 px-5 py-2 rounded-lg transition">
                Retour à la Liste des Commandes
            </a>
        </div>
    </div>
</div>

<!-- Script JS -->
<script>
    let productIndex = 1;

    document.getElementById('add-product').addEventListener('click', function () {
        const container = document.getElementById('products-container');
        const newRow = document.createElement('div');
        newRow.classList.add('product-row', 'flex', 'flex-col', 'md:flex-row', 'md:items-center', 'md:space-x-6', 'space-y-4', 'md:space-y-0');
        newRow.innerHTML = `
            <div class="w-full">
                <label class="block text-sm font-medium text-gray-700">Produit</label>
                <select name="products[${productIndex}][product_id]" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 text-sm" required>
                    <option value="">Sélectionner un Produit</option>
                    @foreach($products as $product)
                        <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full">
                <label class="block text-sm font-medium text-gray-700">Quantité</label>
                <input type="number" name="products[${productIndex}][quantity]" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 text-sm" required min="1">
            </div>
            <button type="button" class="mt-2 md:mt-6 bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded remove-product">
                Supprimer
            </button>
        `;
        container.appendChild(newRow);
        productIndex++;
    });

    document.getElementById('products-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-product')) {
            e.target.closest('.product-row').remove();
        }
    });
</script>
@endsection
