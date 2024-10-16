@extends('appointments.layout')
@section('content')
<div class="container">
    <h1>Détails du Rendez-vous #{{ $appointment->appointment_id }}</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>Client:</strong> {{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</li>
        <li class="list-group-item"><strong>Commercial:</strong> {{ $appointment->salesperson->first_name }} {{ $appointment->salesperson->last_name }}</li>
        <li class="list-group-item"><strong>Date et Heure:</strong> {{ \Carbon\Carbon::parse($appointment->date_time)->format('d/m/Y H:i') }}</li>
        <li class="list-group-item"><strong>Lieu:</strong> {{ $appointment->location }}</li>
        <li class="list-group-item"><strong>Statut:</strong> {{ $appointment->status }}</li>
    </ul>

    <a href="{{ route('appointments.index') }}" class="btn btn-secondary mt-3">Retour à la Liste</a>
    <a href="{{ route('appointments.edit', $appointment->appointment_id) }}" class="btn btn-warning">Modifier le Rendez-vous</a>
    <form action="{{ route('appointments.destroy', $appointment->appointment_id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer le Rendez-vous</button>
    </form>
</div>
@endsection