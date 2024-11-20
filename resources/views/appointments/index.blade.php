@extends('appointments.layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Liste des Rendez-vous</h2>
            <div class="flex space-x-2">
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('dashboard') }}">
                    <i class="fa fa-home"></i> Retour au Dashboard
                </a>
                <a class="btn btn-success bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('appointments.create') }}">
                    <i class="fa fa-plus-circle"></i> Ajouter un Rendez-vous
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-green-500 text-white p-3 rounded mb-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('appointments.index') }}" method="GET" class="mb-4">
            <label for="client_id" class="block mb-2">Filtrer par Client:</label>
            <select name="client_id" id="client_id" class="form-select mb-3">
                <option value="">Tous les Clients</option>
                @foreach($clients as $client)
                    <option value="{{ $client->client_id }}">{{ $client->first_name }} {{ $client->last_name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Filtrer</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="w-full bg-gray-100 text-left">
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Commercial</th>
                        <th class="py-2 px-4 border-b">Client</th>
                        <th class="py-2 px-4 border-b">Date et Heure</th>
                        <th class="py-2 px-4 border-b">Lieu</th>
                        <th class="py-2 px-4 border-b">Statut</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $appointment->appointment_id }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->user->first_name }} {{ $appointment->user->last_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($appointment->date_time)->format('d/m/Y H:i') }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->location }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->status }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center">
                                    <a class="btn btn-info bg-blue-300 hover:bg-blue-400 text-white px-3 py-1 rounded mr-2" href="{{ route('appointments.show', $appointment->appointment_id) }}">Voir</a>
                                    <a class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded mr-2" href="{{ route('appointments.edit', $appointment->appointment_id) }}">Modifier</a>
                                    <form action="{{ route('appointments.destroy', $appointment->appointment_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?')">Supprimer</button>
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
