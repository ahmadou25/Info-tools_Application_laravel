@extends('appointments.layout')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-semibold mb-6">Modifier le Rendez-vous #{{ $appointment->appointment_id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-4 p-4 bg-red-500 text-white rounded-lg">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.update', $appointment->appointment_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="id" class="form-label text-lg font-medium">Client</label>
            <select name="id" id="id" class="form-select p-3 border border-gray-300 rounded-lg w-full" required>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $appointment->id ? 'selected' : '' }}>
                        {{ $client->first_name }} {{ $client->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="date_time" class="form-label text-lg font-medium">Date et Heure</label>
            <input type="datetime-local" name="date_time" id="date_time" class="form-control p-3 border border-gray-300 rounded-lg w-full" required value="{{ \Carbon\Carbon::parse($appointment->date_time)->format('Y-m-d\TH:i') }}">
        </div>

        <div class="mb-4">
            <label for="location" class="form-label text-lg font-medium">Lieu</label>
            <input type="text" name="location" id="location" class="form-control p-3 border border-gray-300 rounded-lg w-full" required value="{{ $appointment->location }}">
        </div>

        <div class="mb-4">
            <label for="status" class="form-label text-lg font-medium">Statut</label>
            <select name="status" id="status" class="form-select p-3 border border-gray-300 rounded-lg w-full" required>
                <option value="Planned" {{ $appointment->status == 'Planned' ? 'selected' : '' }}>Planifié</option>
                <option value="Realized" {{ $appointment->status == 'Realized' ? 'selected' : '' }}>Réalisé</option>
                <option value="Canceled" {{ $appointment->status == 'Canceled' ? 'selected' : '' }}>Annulé</option>
            </select>
        </div>

        <div class="flex justify-between mt-6">
            <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                Mettre à jour le Rendez-vous
            </button>
            <a href="{{ route('appointments.index') }}" class="btn bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                Retour à la Liste
            </a>
        </div>
    </form>
</div>
@endsection
