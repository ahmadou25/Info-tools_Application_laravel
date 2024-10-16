@extends('clients.layout')

@section('content')
<div class="container">
    <h1>Modifier le Client #{{ $client->client_id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.update', $client->client_id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="first_name" class="form-label">Prénom</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required value="{{ $client->first_name }}">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Nom</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required value="{{ $client->last_name }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ $client->email }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Téléphone</label>
            <input type="text" name="phone" id="phone" class="form-control" required value="{{ $client->phone }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" name="address" id="address" class="form-control" required value="{{ $client->address }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour le Client</button>
    </form>
</div>
@endsection