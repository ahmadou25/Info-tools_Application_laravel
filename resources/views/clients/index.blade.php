@extends('clients.layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Liste des Clients</h2>
            <div class="flex space-x-3">
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg" href="{{ route('dashboard') }}">
                    <i class="fa fa-home"></i> Retour au Dashboard
                </a>
                <a class="btn btn-success bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg" href="{{ route('clients.create') }}">
                    <i class="fa fa-plus-circle"></i> Ajouter un Client
                </a>
            </div>
        </div>

        <!-- Formulaire de recherche par nom -->
        <form action="{{ route('clients.index') }}" method="GET" class="mb-6">
            <div class="flex items-center space-x-2">
                <label for="search" class="text-lg font-medium text-gray-700">Rechercher par Nom:</label>
                <input type="text" name="search" id="search" class="form-input mb-3 p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Entrez un prénom ou nom" value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md">Filtrer</button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success bg-green-500 text-white p-4 rounded-lg mb-4 shadow-md">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger bg-red-500 text-white p-4 rounded-lg mb-4 shadow-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="w-full bg-gray-100 text-left">
                        <th class="py-3 px-6 border-b">ID</th>
                        <th class="py-3 px-6 border-b">Prénom</th>
                        <th class="py-3 px-6 border-b">Nom</th>
                        <th class="py-3 px-6 border-b">Email</th>
                        <th class="py-3 px-6 border-b">Téléphone</th>
                        <th class="py-3 px-6 border-b">Adresse</th>
                        <th class="py-3 px-6 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr class="hover:bg-gray-50 transition-colors duration-300">
                            <td class="py-3 px-6 border-b text-center">{{ $client->id }}</td>
                            <td class="py-3 px-6 border-b text-center">{{ $client->first_name }}</td>
                            <td class="py-3 px-6 border-b text-center">{{ $client->last_name }}</td>
                            <td class="py-3 px-6 border-b text-center">{{ $client->email }}</td>
                            <td class="py-3 px-6 border-b text-center">{{ $client->phone }}</td>
                            <td class="py-3 px-6 border-b text-center">{{ $client->address }}</td>
                            <td class="py-3 px-6 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <a class="btn btn-info bg-blue-300 hover:bg-blue-400 text-white px-4 py-2 rounded-lg shadow-sm" href="{{ route('clients.show', $client->id) }}">Voir</a>

                                    @if(!Auth::user()->hasRole('Salesperson'))
                                        <a class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm" href="{{ route('clients.edit', $client->id) }}">Modifier</a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $clients->links() }}
        </div>
    </div>
@endsection
