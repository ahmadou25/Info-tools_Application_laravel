@extends('users.layout') <!-- Modifier selon votre layout principal -->

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Liste des Commerciaux</h2>
            <div class="flex space-x-2">
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('dashboard') }}">
                    <i class="fa fa-home"></i> Retour au Dashboard
                </a>
                <a class="btn btn-success bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('users.create') }}">
                    <i class="fa fa-plus-circle"></i> Ajouter un Commercial
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
                        <th class="py-2 px-4 border-b">Identifiant</th>
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Prénom</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->last_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->first_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center">
                                    <a class="btn btn-info bg-blue-300 hover:bg-blue-400 text-white px-3 py-1 rounded mr-2" href="{{ route('users.show', $user->id) }}">Voir</a>
                                    <a class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded mr-2" href="{{ route('users.edit', $user->id) }}">Modifier</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commercial ?')">Supprimer</button>
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
