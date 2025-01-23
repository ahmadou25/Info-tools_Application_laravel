@extends('users.layout') <!-- Modifier selon votre layout principal -->

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Créer un Commercial</h1>

    @if($errors->any())
        <div class="alert alert-danger bg-red-500 text-white p-4 rounded mb-6">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        {{-- Prénom --}}
        <div class="mb-4">
            <label for="first_name" class="block mb-2 font-semibold">Prénom</label>
            <input type="text" name="first_name" id="first_name" class="form-control w-full border-gray-300 rounded-lg p-3" value="{{ old('first_name') }}" required>
        </div>

        {{-- Nom de famille --}}
        <div class="mb-4">
            <label for="last_name" class="block mb-2 font-semibold">Nom</label>
            <input type="text" name="last_name" id="last_name" class="form-control w-full border-gray-300 rounded-lg p-3" value="{{ old('last_name') }}" required>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block mb-2 font-semibold">Email</label>
            <input type="email" name="email" id="email" class="form-control w-full border-gray-300 rounded-lg p-3" value="{{ old('email') }}" required>
        </div>

        {{-- Rôle --}}
        <div class="mb-4">
            <label for="role" class="block mb-2 font-semibold">Rôle</label>
            <select name="role" id="role" class="form-select w-full border-gray-300 rounded-lg p-3" required>
                <option value="">Sélectionner un rôle</option>
                <option value="Salesperson" {{ old('role') === 'Salesperson' ? 'selected' : '' }}>Commercial</option>
                @if(auth()->user()->role === 'Admin') <!-- Si un Admin crée des commerciaux -->
                <option value="Manager" {{ old('role') === 'Manager' ? 'selected' : '' }}>Manager</option>
                @endif
            </select>
        </div>

        {{-- Manager (si l'utilisateur est un Admin) --}}
        @if(auth()->user()->role === 'Admin')
            <div class="mb-4">
                <label for="ad_id" class="block mb-2 font-semibold">Manager</label>
                <select name="ad_id" id="ad_id" class="form-select w-full border-gray-300 rounded-lg p-3">
                    <option value="">Aucun</option>
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}" {{ old('ad_id') == $manager->id ? 'selected' : '' }}>
                            {{ $manager->first_name }} {{ $manager->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @elseif(auth()->user()->role === 'Manager')
            <input type="hidden" name="ad_id" value="{{ auth()->user()->id }}">
        @endif

        {{-- Mot de passe --}}
        <div class="mb-4">
            <label for="password" class="block mb-2 font-semibold">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control w-full border-gray-300 rounded-lg p-3" required>
        </div>

        {{-- Confirmation du mot de passe --}}
        <div class="mb-4">
            <label for="password_confirmation" class="block mb-2 font-semibold">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control w-full border-gray-300 rounded-lg p-3" required>
        </div>

        {{-- Adresse --}}
        <div class="mb-4">
            <label for="address" class="block mb-2 font-semibold">Adresse</label>
            <input type="text" name="address" id="address" class="form-control w-full border-gray-300 rounded-lg p-3" value="{{ old('address') }}">
        </div>

        {{-- Numéro de téléphone --}}
        <div class="mb-4">
            <label for="phone_number" class="block mb-2 font-semibold">Numéro de téléphone</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control w-full border-gray-300 rounded-lg p-3" value="{{ old('phone_number') }}">
        </div>

        {{-- Date de début --}}
        <div class="mb-4">
            <label for="start_date" class="block mb-2 font-semibold">Date de début</label>
            <input type="date" name="start_date" id="start_date" class="form-control w-full border-gray-300 rounded-lg p-3" value="{{ old('start_date') }}">
        </div>

        <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md w-full">
            Créer le Commercial
        </button>
    </form>

    <!-- Bouton retour -->
    <div class="mt-6 flex justify-center">
        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-6 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400">
            Retour à la Liste des Commerciaux
        </a>
    </div>
</div>
@endsection
