@extends('products.layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Éditer un Produit</h2>
            <div>
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('products.index') }}">Retour</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger bg-red-500 text-white p-3 rounded mb-4">
                <strong>Oops!</strong> Il y a des soucis dans votre formulaire.<br><br>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700" for="name"><strong>Nom :</strong></label>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Nom du produit" required>
                </div>

                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700" for="description"><strong>Description :</strong></label>
                    <textarea class="form-control mt-1 block w-full p-2 border border-gray-300 rounded" style="height:150px" name="description" required>{{ $product->description }}</textarea>
                </div>

                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700" for="price"><strong>Prix :</strong></label>
                    <input type="number" name="price" value="{{ $product->price }}" class="form-control mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Prix du produit" required>
                </div>

                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700" for="stock"><strong>Stock :</strong></label>
                    <input type="number" name="stock" value="{{ $product->stock }}" class="form-control mt-1 block w-full p-2 border border-gray-300 rounded" placeholder="Quantité en stock" required>
                </div>

                <div class="col-span-2 mt-4">
                    <button type="submit" class="btn btn-success bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Mettre à jour</button>
                </div>
            </div>
        </form>
    </div>
@endsection
