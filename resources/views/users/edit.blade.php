@extends('users.layout') <!-- Modifier selon votre layout principal -->

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Modifier l'utilisateur #{{ $user->id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger bg-red-500 text-white p-4 rounded mb-6">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Prénom --}}
        <div class="mb-4">
            <label for="first_name" class="block mb-2 font-semibold">Prénom</label>
            <input type="text" name="first_name" id="first_name" class="form-control w-full border-gray-300 rounded-lg" value="{{ $user->first_name }}" required>
        </div>

        {{-- Nom de famille --}}
        <div class="mb-4">
            <label for="last_name" class="block mb-2 font-semibold">Nom</label>
            <input type="text" name="last_name" id="last_name" class="form-control w-full border-gray-300 rounded-lg" value="{{ $user->last_name }}" required>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block mb-2 font-semibold">Email</label>
            <input type="email" name="email" id="email" class="form-control w-full border-gray-300 rounded-lg" value="{{ $user->email }}" required>
        </div>

        {{-- Rôle --}}
        <div class="mb-4">
            <label for="role" class="block mb-2 font-semibold">Rôle</label>
            <select name="role" id="role" class="form-select w-full border-gray-300 rounded-lg" required>
                <option value="Salesperson" {{ $user->role == 'Salesperson' ? 'selected' : '' }}>Commercial</option>
                @if(auth()->user()->role === 'Admin') <!-- Si un Admin modifie l'utilisateur -->
                <option value="Manager" {{ $user->role == 'Manager' ? 'selected' : '' }}>Manager</option>
                @endif
            </select>
        </div>

        {{-- Manager (si l'utilisateur est un Admin) --}}
        @if(auth()->user()->role === 'Admin')
            <div class="mb-4">
                <label for="ad_id" class="block mb-2 font-semibold">Manager</label>
                <select name="ad_id" id="ad_id" class="form-select w-full border-gray-300 rounded-lg">
                    <option value="">Aucun</option>
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}" {{ $manager->id == $user->ad_id ? 'selected' : '' }}>
                            {{ $manager->first_name }} {{ $manager->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        {{-- Mot de passe (optionnel) --}}
        <div class="mb-4">
            <label for="password" class="block mb-2 font-semibold">Mot de passe (Laisser vide pour ne pas changer)</label>
            <input type="password" name="password" id="password" class="form-control w-full border-gray-300 rounded-lg">
        </div>

        {{-- Confirmation du mot de passe --}}
        <div class="mb-4">
            <label for="password_confirmation" class="block mb-2 font-semibold">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control w-full border-gray-300 rounded-lg">
        </div>

        <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Mettre à jour l'utilisateur</button>
    </form>
</div>
@endsection
