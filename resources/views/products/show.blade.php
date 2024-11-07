@extends('products.layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Détails du Produit</h2>
            <div>
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('products.index') }}">Retour</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700"><strong>Nom :</strong></label>
                <p class="mt-1 text-gray-900">{{ $product->name }}</p>
            </div>

            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700"><strong>Description :</strong></label>
                <p class="mt-1 text-gray-900">{{ $product->description }}</p>
            </div>

            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700"><strong>Prix :</strong></label>
                <p class="mt-1 text-gray-900">{{ $product->price }}</p>
            </div>

            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700"><strong>Stock :</strong></label>
                <p class="mt-1 text-gray-900">{{ $product->stock }}</p>
            </div>
        </div>
    </div>
@endsection
