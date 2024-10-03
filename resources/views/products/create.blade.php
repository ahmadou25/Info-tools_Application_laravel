@extends('products.layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Ajouter un Produit</h2>
            <div>
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('products.index') }}">Retour</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <strong>Oops!</strong> Il y a des soucis dans votre formulaire.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700"><strong>Nom :</strong></label>
                    <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Nom du produit" required>
                </div>

                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700"><strong>Description :</strong></label>
                    <textarea class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" style="height:150px" name="description" placeholder="Description du produit" required></textarea>
                </div>

                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700"><strong>Prix :</strong></label>
                    <input type="number" name="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Prix du produit" required>
                </div>

                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700"><strong>Stock :</strong></label>
                    <input type="number" name="stock" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Quantité en stock" required>
                </div>

                <div class="col-span-2" style="margin-top:20px">
                    <button type="submit" class="btn btn-success bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
@endsection
