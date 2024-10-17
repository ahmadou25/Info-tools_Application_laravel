@extends('appointments.layout')

@section('content')
<div class="container">
    <h1>Modifier le Rendez-vous #{{ $appointment->appointment_id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
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
        
        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" id="client_id" class="form-select" required>
                @foreach($clients as $client)
                    <option value="{{ $client->client_id }}" {{ $client->client_id == $appointment->client_id ? 'selected' : '' }}>
                        {{ $client->first_name }} {{ $client->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date_time" class="form-label">Date et Heure</label>
            <input type="datetime-local" name="date_time" id="date_time" class="form-control" required value="{{ \Carbon\Carbon::parse($appointment->date_time)->format('Y-m-d\TH:i') }}">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lieu</label>
            <input type="text" name="location" id="location" class="form-control" required value="{{ $appointment->location }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Planned" {{ $appointment->status == 'Planned' ? 'selected' : '' }}>Planifié</option>
                <option value="Realized" {{ $appointment->status == 'Realized' ? 'selected' : '' }}>Réalisé</option>
                <option value="Canceled" {{ $appointment->status == 'Canceled' ? 'selected' : '' }}>Annulé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour le Rendez-vous</button>
    </form>
</div>
@endsection
