@extends('products.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <!-- En-tête avec bouton de retour -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Détails du Produit</h2>
                    <a href="{{ route('products.index') }}" class="flex items-center text-blue-200 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Retour à la liste
                    </a>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Section gauche -->
                    <div class="space-y-6">
                        <!-- Image du produit -->
                        <div class="bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center h-64">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-contain">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            @endif
                        </div>

                        <!-- Informations secondaires -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Référence</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ $product->sku ?? 'Non spécifiée' }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Poids</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ $product->weight ? $product->weight.' kg' : 'Non spécifié' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section droite - Informations principales -->
                    <div class="space-y-6">
                        <!-- Nom et catégorie -->
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                            <div class="mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $product->category ?? 'Non catégorisé' }}
                                </span>
                            </div>
                        </div>

                        <!-- Prix et stock -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500">Prix</h3>
                                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($product->price, 2) }} €</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500">Stock</h3>
                                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $product->stock }}</p>
                                <p class="mt-1 text-xs text-gray-500">
                                    @if($product->stock > 10)
                                        <span class="text-green-600">En stock</span>
                                    @elseif($product->stock > 0)
                                        <span class="text-yellow-600">Stock faible</span>
                                    @else
                                        <span class="text-red-600">Rupture de stock</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Description</h3>
                            <div class="mt-2 prose prose-sm max-w-none text-gray-500">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="pt-4 border-t border-gray-200 flex space-x-3">
                            <a href="{{ route('products.edit', $product->product_id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Modifier
                            </a>
                            <form action="{{ route('products.destroy', $product->product_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection