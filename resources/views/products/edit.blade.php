@extends('products.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <!-- En-tête avec bouton de retour -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Éditer le Produit</h2>
                    <a href="{{ route('products.index') }}" class="flex items-center text-blue-200 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Retour à la liste
                    </a>
                </div>
            </div>

            <!-- Messages d'erreur -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mx-6 mt-6 rounded-lg">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <h3 class="text-red-800 font-medium">Des erreurs ont été détectées :</h3>
                    </div>
                    <ul class="mt-2 list-disc list-inside text-red-600 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire -->
            <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom du produit -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nom du produit <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="name" name="name" required
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                placeholder="Ex: Smartphone X Pro"
                                value="{{ old('name', $product->name) }}">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Catégorie -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                            Catégorie
                        </label>
                        <select id="category" name="category"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="Electronique" {{ old('category', $product->category) == 'Electronique' ? 'selected' : '' }}>Electronique</option>
                            <option value="Vêtements" {{ old('category', $product->category) == 'Vêtements' ? 'selected' : '' }}>Vêtements</option>
                            <option value="Alimentation" {{ old('category', $product->category) == 'Alimentation' ? 'selected' : '' }}>Alimentation</option>
                            <option value="Maison" {{ old('category', $product->category) == 'Maison' ? 'selected' : '' }}>Maison</option>
                            <option value="Autre" {{ old('category', $product->category) == 'Autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>

                    <!-- Prix -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                            Prix (€) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" id="price" name="price" step="0.01" min="0" required
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                placeholder="Ex: 299.99"
                                value="{{ old('price', $product->price) }}">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                            Quantité en stock <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" min="0" required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                            placeholder="Ex: 50"
                            value="{{ old('stock', $product->stock) }}">
                    </div>

                    <!-- Référence SKU -->
                    <div>
                        <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">
                            Référence SKU
                        </label>
                        <input type="text" id="sku" name="sku"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                            placeholder="Ex: PROD-12345"
                            value="{{ old('sku', $product->sku) }}">
                    </div>

                    <!-- Poids -->
                    <div>
                        <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">
                            Poids (kg)
                        </label>
                        <div class="relative">
                            <input type="number" id="weight" name="weight" step="0.01" min="0"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                placeholder="Ex: 0.5"
                                value="{{ old('weight', $product->weight) }}">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500">kg</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description" name="description" rows="4" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                        placeholder="Décrivez le produit en détails...">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Image upload -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                        Image du produit
                    </label>
                    <div class="mt-1 flex items-center">
                    <div class="image-preview-container">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="Image actuelle" class="h-12 w-12 rounded-full object-cover">
                        @else
                            <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                        @endif
                    </div>
                    
                    <input type="file" name="image" id="image" class="ml-5 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0 file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="flex justify-end pt-6 border-t border-gray-200">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Mettre à jour le produit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Crée ou met à jour la prévisualisation
                const previewContainer = document.querySelector('.image-preview-container');
                previewContainer.innerHTML = `
                    <img src="${event.target.result}" class="h-12 w-12 rounded-full object-cover" />
                `;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection