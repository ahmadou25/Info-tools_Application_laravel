@extends('appointments.layout')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold mb-6">Planifier un Rendez-vous</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        {{-- Sélection du client --}}
        <div class="mb-4">
            <label for="id" class="form-label block text-lg">Client</label>
            <select name="id" id="id" class="form-select border-gray-300 p-2 w-full rounded-lg" required>
                <option value="">Sélectionner un Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->first_name }} {{ $client->last_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Si l'utilisateur est un Manager, afficher la liste des commerciaux --}}
        @if(auth()->user()->role === 'Manager')
            <div class="mb-4">
                <label for="commercial_id" class="form-label block text-lg">Commercial</label>
                <select name="commercial_id" id="commercial_id" class="form-select border-gray-300 p-2 w-full rounded-lg" required>
                    <option value="">Sélectionner un Commercial</option>
                    @foreach($commercials as $commercial)
                        <option value="{{ $commercial->id }}">{{ $commercial->first_name }} {{ $commercial->last_name }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        @endif

        {{-- Sélection de la date et heure --}}
        <div class="mb-4">
            <label for="date_time" class="form-label block text-lg">Date et Heure</label>
            <input type="datetime-local" name="date_time" id="date_time" class="form-control border-gray-300 p-2 w-full rounded-lg" required>
        </div>

        {{-- Lieu --}}
        <div class="mb-4">
            <label for="location" class="form-label block text-lg">Lieu</label>
            <input type="text" name="location" id="location" class="form-control border-gray-300 p-2 w-full rounded-lg" required>
        </div>

        <button type="submit" class="btn bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Planifier le Rendez-vous</button>
    </form>

    <!-- Bouton retour -->
    <div class="mt-6">
        <a href="{{ route('appointments.index') }}" class="btn bg-gray-500 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">
            Retour à la Liste
        </a>
    </div>
</div>
@endsection
