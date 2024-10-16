@extends('clients.layout')
@section('content')
<div class="container">
    <h1>Détails du Client #{{ $client->client_id }}</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>Prénom:</strong> {{ $client->first_name }}</li>
        <li class="list-group-item"><strong>Nom:</strong> {{ $client->last_name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $client->email }}</li>
        <li class="list-group-item"><strong>Téléphone:</strong> {{ $client->phone }}</li>
        <li class="list-group-item"><strong>Adresse:</strong> {{ $client->address }}</li>
    </ul>

    <a href="{{ route('clients.index') }}" class="btn btn-secondary mt-3">Retour à la Liste</a>
    <a href="{{ route('clients.edit', $client->client_id) }}" class="btn btn-warning">Modifier le Client</a>
    <form action="{{ route('clients.destroy', $client->client_id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer le Client</button>
    </form>
</div>
@endsection