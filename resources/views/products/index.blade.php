@extends('products.layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Gestion des Produits</h2>
            <div class="flex space-x-2">
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('dashboard') }}">
                    <i class='fa fa-home'></i> Retour à l'Accueil
                </a>
                
                @can('create', App\Models\Product::class)
                    <a class="btn btn-success bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('products.create') }}">
                        <i class='fa fa-plus-circle'></i> Ajouter un Produit
                    </a>
                @endcan
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success bg-green-500 text-white p-3 rounded mb-4">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="w-full bg-gray-100 text-left">
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Description</th>
                        <th class="py-2 px-4 border-b">Prix</th>
                        <th class="py-2 px-4 border-b">Stock</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $product->product_id }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->description }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->price }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->stock }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center">
                                    @can('view', $product)
                                        <a class="btn btn-info bg-blue-300 hover:bg-blue-400 text-white px-3 py-1 rounded mr-2" href="{{ route('products.show', $product->product_id) }}">Détails</a>
                                    @endcan

                                    @can('update', $product)
                                        <a class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded mr-2" href="{{ route('products.edit', $product->product_id) }}">Editer</a>
                                    @endcan

                                    @can('delete', $product)
                                        <form action="{{ route('products.destroy', $product->product_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
