@extends('clients.layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Détails du Client</h2>
            <div>
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('clients.index') }}">Retour</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700"><strong>Nom :</strong></label>
                <p class="mt-1 text-gray-900">{{ $client->last_name }}</p>
            </div>

            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700"><strong>Prénom :</strong></label>
                <p class="mt-1 text-gray-900">{{ $client->first_name }}</p>
            </div>

            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700"><strong>Email :</strong></label>
                <p class="mt-1 text-gray-900">{{ $client->email }}</p>
            </div>

            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700"><strong>Téléphone :</strong></label>
                <p class="mt-1 text-gray-900">{{ $client->phone }}</p>
            </div>

            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700"><strong>Adresse :</strong></label>
                <p class="mt-1 text-gray-900">{{ $client->address }}</p>
            </div>

            <div class="form-group">
                <label class="block text-sm font-medium text-gray-700"><strong>Type :</strong></label>
                <p class="mt-1 text-gray-900">{{ $client->type }}</p>
            </div>
        </div>
    </div>
@endsection
