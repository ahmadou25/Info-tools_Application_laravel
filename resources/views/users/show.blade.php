@extends('users.layout') <!-- Adapter selon votre layout principal -->

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Détails du Commercial #{{ $user->id }}</h1>

    <ul class="list-group border border-gray-300 rounded-lg p-4">
        <li class="list-group-item"><strong>Nom :</strong> {{ $user->first_name }} {{ $user->last_name }}</li>
        <li class="list-group-item"><strong>Email :</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Rôle :</strong> {{ ucfirst($user->role) }}</li>

        {{-- Afficher le Manager si l'utilisateur est un Commercial --}}
        @if($user->role === 'Salesperson' && $user->manager)
            <li class="list-group-item"><strong>Manager :</strong> {{ $user->manager->first_name }} {{ $user->manager->last_name }}</li>
        @endif

        {{-- Affichage de l'adresse --}}
        <li class="list-group-item"><strong>Adresse :</strong> {{ $user->address ?? 'Non renseignée' }}</li>

        {{-- Affichage du numéro de téléphone --}}
        <li class="list-group-item"><strong>Numéro de téléphone :</strong> {{ $user->phone_number ?? 'Non renseigné' }}</li>

        {{-- Affichage de la date de début --}}
        <li class="list-group-item"><strong>Date de début :</strong> {{ $user->start_date ? \Carbon\Carbon::parse($user->start_date)->format('d-m-Y') : 'Non renseignée' }}</li>
    </ul>

    <div class="mt-6 space-x-4 flex justify-center">
        <a href="{{ route('users.index') }}" class="btn bg-blue-500 text-white hover:bg-blue-600 px-6 py-3 rounded-md">Retour à la Liste des Commerciaux</a>
        <a href="{{ route('users.edit', $user->id) }}" class="btn bg-yellow-500 text-white hover:bg-yellow-600 px-6 py-3 rounded-md">Modifier le Commercial</a>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600 px-6 py-3 rounded-md">Supprimer le Commercial</button>
        </form>
    </div>
</div>
@endsection
