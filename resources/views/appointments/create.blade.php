@extends('appointments.layout')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">Planifier un Rendez-vous</h1>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Il y a {{ count($errors) }} erreur(s) dans votre formulaire</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Sélection du client -->
            <div>
                <label for="id" class="block text-sm font-medium text-gray-700">Client <span class="text-red-500">*</span></label>
                <select name="id" id="id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                    <option value="">Sélectionner un Client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('id') == $client->id ? 'selected' : '' }}>{{ $client->first_name }} {{ $client->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Si l'utilisateur est un Manager, afficher la liste des commerciaux -->
            @if(auth()->user()->role === 'Manager')
                <div>
                    <label for="commercial_id" class="block text-sm font-medium text-gray-700">Commercial <span class="text-red-500">*</span></label>
                    <select name="commercial_id" id="commercial_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                        <option value="">Sélectionner un Commercial</option>
                        @foreach($commercials as $commercial)
                            <option value="{{ $commercial->id }}" {{ old('commercial_id') == $commercial->id ? 'selected' : '' }}>{{ $commercial->first_name }} {{ $commercial->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            @endif

            <!-- Sélection de la date et heure -->
            <div>
                <label for="date_time" class="block text-sm font-medium text-gray-700">Date et Heure <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="date_time" id="date_time" value="{{ old('date_time') }}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
            </div>

            <!-- Lieu -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Lieu <span class="text-red-500">*</span></label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                <a href="{{ route('appointments.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Retour à la Liste
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Planifier le Rendez-vous
                </button>
            </div>
        </form>
    </div>
</div>
@endsection