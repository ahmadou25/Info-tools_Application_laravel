@extends('clients.layout')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-semibold mb-6">Détails du Client #{{ $client->id }}</h1>

    <ul class="list-group space-y-4">
        <li class="list-group-item p-4 border border-gray-300 rounded-md shadow-sm">
            <strong class="text-lg font-medium">Prénom:</strong> {{ $client->first_name }}
        </li>
        <li class="list-group-item p-4 border border-gray-300 rounded-md shadow-sm">
            <strong class="text-lg font-medium">Nom:</strong> {{ $client->last_name }}
        </li>
        <li class="list-group-item p-4 border border-gray-300 rounded-md shadow-sm">
            <strong class="text-lg font-medium">Email:</strong> {{ $client->email }}
        </li>
        <li class="list-group-item p-4 border border-gray-300 rounded-md shadow-sm">
            <strong class="text-lg font-medium">Téléphone:</strong> {{ $client->phone }}
        </li>
        <li class="list-group-item p-4 border border-gray-300 rounded-md shadow-sm">
            <strong class="text-lg font-medium">Adresse:</strong> {{ $client->address }}
        </li>
    </ul>

    <div class="mt-6 flex space-x-4">
        <a href="{{ route('clients.index') }}" class="btn bg-blue-500 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            Retour à la Liste
        </a>
        
        <a href="{{ route('clients.edit', $client->id) }}" class="btn bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
            Modifier le Client
        </a>
        @if(!Auth::user()->hasRole('Salesperson'))
            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    Supprimer le Client
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
