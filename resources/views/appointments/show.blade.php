@extends('appointments.layout')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg pb-8"> <!-- Ajout de padding-bottom ici -->
    <h1 class="text-3xl font-semibold mb-6">Détails du Rendez-vous #{{ $appointment->appointment_id }}</h1>

    <ul class="list-group space-y-4">
        <li class="list-group-item p-4 bg-gray-100 rounded-md shadow-sm">
            <strong class="text-lg">Client:</strong> {{ $appointment->client->first_name }} {{ $appointment->client->last_name }}
        </li>
        <li class="list-group-item p-4 bg-gray-100 rounded-md shadow-sm">
            <strong class="text-lg">Date et Heure:</strong> {{ \Carbon\Carbon::parse($appointment->date_time)->format('d/m/Y H:i') }}
        </li>
        <li class="list-group-item p-4 bg-gray-100 rounded-md shadow-sm">
            <strong class="text-lg">Lieu:</strong> {{ $appointment->location }}
        </li>
        <li class="list-group-item p-4 bg-gray-100 rounded-md shadow-sm">
            <strong class="text-lg">Statut:</strong> {{ $appointment->status }}
        </li>
    </ul>

    <div class="mt-6"></div> <!-- Cette ligne crée un espace entre les détails et les boutons -->

    <div class="flex space-x-4 mt-6">
        <a href="{{ route('appointments.index') }}" class="btn bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            Retour à la Liste
        </a>
        <a href="{{ route('appointments.edit', $appointment->appointment_id) }}" class="btn bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
            Modifier le Rendez-vous
        </a>

        @auth
            @if(auth()->user()->role === 'Manager')
                <form action="{{ route('appointments.destroy', $appointment->appointment_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-500">
                        Supprimer le Rendez-vous
                    </button>
                </form>
            @endif
        @endauth
    </div>
</div>
@endsection
