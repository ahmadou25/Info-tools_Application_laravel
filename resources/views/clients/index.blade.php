@extends('clients.layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Liste des Clients</h2>
            <div class="flex space-x-2">
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('dashboard') }}">
                    <i class="fa fa-home"></i> Retour au Dashboard
                </a>
                <a class="btn btn-success bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('clients.create') }}">
                    <i class="fa fa-plus-circle"></i> Ajouter un Client
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-green-500 text-white p-3 rounded mb-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="w-full bg-gray-100 text-left">
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Prénom</th>
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Téléphone</th>
                        <th class="py-2 px-4 border-b">Adresse</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $client->client_id }}</td>
                            <td class="py-2 px-4 border-b">{{ $client->first_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $client->last_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $client->email }}</td>
                            <td class="py-2 px-4 border-b">{{ $client->phone }}</td>
                            <td class="py-2 px-4 border-b">{{ $client->address }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center">
                                    <a class="btn btn-info bg-blue-300 hover:bg-blue-400 text-white px-3 py-1 rounded mr-2" href="{{ route('clients.show', $client->client_id) }}">Voir</a>
                                    <a class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded mr-2" href="{{ route('clients.edit', $client->client_id) }}">Modifier</a>
                                    <form action="{{ route('clients.destroy', $client->client_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection