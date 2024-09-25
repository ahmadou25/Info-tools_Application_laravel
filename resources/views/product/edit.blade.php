<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceInput = document.getElementById('price');
        const stockInput = document.getElementById('stock');
        const quantityInput = document.getElementById('quantity');
        const amountDisplay = document.getElementById('calculated_amount');

        function updateAmount() {
            const price = priceInput.value || 0;
            const stock = stockInput.value || 0;
            const quantity = quantityInput.value || 0;
            const amount = price * quantity;
            
            if (quantity > stock) {
                amountDisplay.value = "Stock insuffisant";
            } else {
                amountDisplay.value = amount.toFixed(2) + ' €';
            }
        }

        quantityInput.addEventListener('input', updateAmount);
    });
</script>

<x-app-layout>
    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full space-y-8 p-2 bg-white shadow overflow-hidden sm:rounded-lg">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Modifier le produit') }}
                </h2>
            </x-slot>

            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Erreur !</strong> Il y a des problèmes avec les données saisies.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('products.update', $product->product_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4">
                    <!-- Nom -->
                    <div class="form-group">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom du produit</label>
                        <input type="text" name="name" id="name" value="{{ $product->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $product->description }}</textarea>
                    </div>

                    <!-- Prix -->
                    <div class="form-group">
                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Prix (€)</label>
                        <input type="number" name="price" id="price" value="{{ $product->price }}" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- Stock -->
                    <div class="form-group">
                        <label for="stock" class="block text-gray-700 text-sm font-bold mb-2">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ $product->stock }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- Montant calculé -->
                    <div class="form-group">
                        <label for="calculated_amount" class="block text-gray-700 text-sm font-bold mb-2">Montant Calculé</label>
                        <input type="text" name="calculated_amount" id="calculated_amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" readonly>
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Sauvegarder
                    </button>
                    <a href="{{ route('product.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
