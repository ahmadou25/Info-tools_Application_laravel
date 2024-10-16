@extends('appointments.layout')

@section('content')
<div class="container">
    <h1>Planifier un Rendez-vous</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" id="client_id" class="form-select" required>
                <option value="">Sélectionner un Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->client_id }}">{{ $client->first_name }} {{ $client->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="salesperson_id" class="form-label">Commercial</label>
            <select name="salesperson_id" id="salesperson_id" class="form-select" required>
                <option value="">Sélectionner un Commercial</option>
                @foreach($salespersons as $salesperson)
                    <option value="{{ $salesperson->employer_id }}">{{ $salesperson->first_name }} {{ $salesperson->last_name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="date_time" class="form-label">Date et Heure</label>
            <input type="datetime-local" name="date_time" id="date_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lieu</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Planned">Planifié</option>
                <option value="Realized">Réalisé</option>
                <option value="Canceled">Annulé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Planifier le Rendez-vous</button>
    </form>
</div>
@endsection