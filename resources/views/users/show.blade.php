@extends('users.layout') <!-- Adapter selon votre layout principal -->

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Détails de l'Utilisateur #{{ $user->id }}</h1>

    <ul class="list-group border border-gray-300 rounded-lg p-4">
        <li class="list-group-item"><strong>Nom :</strong> {{ $user->first_name }} {{ $user->last_name }}</li>
        <li class="list-group-item"><strong>Email :</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Rôle :</strong> {{ ucfirst($user->role) }}</li>
        @if($user->role === 'Salesperson' && $user->manager)
            <li class="list-group-item"><strong>Manager :</strong> {{ $user->manager->first_name }} {{ $user->manager->last_name }}</li>
        @endif
    </ul>

    <div class="mt-6">
        <a href="{{ route('users.index') }}" class="btn btn-secondary bg-gray-500 text-white hover:bg-gray-600 px-4 py-2 rounded">Retour à la Liste</a>
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning bg-yellow-500 text-white hover:bg-yellow-600 px-4 py-2 rounded">Modifier l'Utilisateur</a>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger bg-red-500 text-white hover:bg-red-600 px-4 py-2 rounded">Supprimer l'Utilisateur</button>
        </form>
    </div>
</div>
@endsection
