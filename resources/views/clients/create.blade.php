@extends('clients.layout')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-semibold mb-6">Créer un Client</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-4 p-4 bg-red-500 text-white rounded-lg">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="first_name" class="form-label text-lg font-medium">Prénom</label>
            <input type="text" name="first_name" id="first_name" class="form-control p-3 border border-gray-300 rounded-lg w-full" required>
        </div>

        <div class="mb-4">
            <label for="last_name" class="form-label text-lg font-medium">Nom</label>
            <input type="text" name="last_name" id="last_name" class="form-control p-3 border border-gray-300 rounded-lg w-full" required>
        </div>

        <div class="mb-4">
            <label for="email" class="form-label text-lg font-medium">Email</label>
            <input type="email" name="email" id="email" class="form-control p-3 border border-gray-300 rounded-lg w-full" required>
        </div>

        <div class="mb-4">
            <label for="phone" class="form-label text-lg font-medium">Téléphone</label>
            <input type="text" name="phone" id="phone" class="form-control p-3 border border-gray-300 rounded-lg w-full" required>
        </div>

        <div class="mb-4">
            <label for="address" class="form-label text-lg font-medium">Adresse</label>
            <input type="text" name="address" id="address" class="form-control p-3 border border-gray-300 rounded-lg w-full" required>
        </div>

        <div class="mb-4">
            <label for="type" class="form-label text-lg font-medium">Type</label>
            <select name="type" class="form-control p-3 border border-gray-300 rounded-lg w-full" required>
                <option value="client">Client</option>
                <option value="prosper">Prospect</option>
            </select>
        </div>

        <div class="flex justify-between mt-6">
            <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                Créer le Client
            </button>
            <a href="{{ route('clients.index') }}" class="btn bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                Retour à la Liste
            </a>
        </div>
    </form>
</div>
@endsection
