@extends('clients.layout')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-semibold mb-6">Modifier le Client #{{ $client->id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-4 p-4 bg-red-500 text-white rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.update', $client->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="first_name" class="form-label block text-lg font-medium mb-2">Prénom</label>
            <input type="text" name="first_name" id="first_name" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ $client->first_name }}">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label block text-lg font-medium mb-2">Nom</label>
            <input type="text" name="last_name" id="last_name" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ $client->last_name }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label block text-lg font-medium mb-2">Email</label>
            <input type="email" name="email" id="email" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ $client->email }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label block text-lg font-medium mb-2">Téléphone</label>
            <input type="text" name="phone" id="phone" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ $client->phone }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label block text-lg font-medium mb-2">Adresse</label>
            <input type="text" name="address" id="address" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ $client->address }}">
        </div>

        <!-- Champ pour modifier le type -->
        <div class="mb-3">
            <label for="type" class="form-label block text-lg font-medium mb-2">Type</label>
            <select name="type" id="type" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="client" {{ $client->type == 'client' ? 'selected' : '' }}>Client</option>
                <option value="prosper" {{ $client->type == 'prosper' ? 'selected' : '' }}>Prosper</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            Mettre à jour le Client
        </button>  

        <a href="{{ route('clients.index') }}" class="btn bg-gray-400 hover:bg-gray-500 text-white mt-3 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
            Retour à la Liste
        </a>
    </form>
</div>
@endsection
