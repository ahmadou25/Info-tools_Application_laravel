@extends('appointments.layout')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-xl shadow-md overflow-hidden p-8">
        <div class="border-b border-gray-200 pb-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Modifier le Rendez-vous N° : {{ $appointment->appointment_id }}</h1>
            <p class="text-gray-600 mt-2">Mettez à jour les détails du rendez-vous</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-lg">
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

        <form action="{{ route('appointments.update', $appointment->appointment_id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Client Selection -->
            <div>
                <label for="id" class="block text-sm font-medium text-gray-700 mb-1">Client <span class="text-red-500">*</span></label>
                <select name="id" id="id" class="mt-1 block w-full pl-3 pr-10 py-3 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm" required>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $client->id == $appointment->id ? 'selected' : '' }}>
                            {{ $client->first_name }} {{ $client->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date and Time -->
            <div>
                <label for="date_time" class="block text-sm font-medium text-gray-700 mb-1">Date et Heure <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="date_time" id="date_time" 
                       class="mt-1 block w-full pl-3 pr-10 py-3 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm" 
                       required value="{{ \Carbon\Carbon::parse($appointment->date_time)->format('Y-m-d\TH:i') }}">
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lieu <span class="text-red-500">*</span></label>
                <input type="text" name="location" id="location" 
                       class="mt-1 block w-full pl-3 pr-10 py-3 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm" 
                       required value="{{ $appointment->location }}">
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Statut <span class="text-red-500">*</span></label>
                <select name="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-3 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm" required>
                    <option value="Planned" {{ $appointment->status == 'Planned' ? 'selected' : '' }}>Planifié</option>
                    <option value="Realized" {{ $appointment->status == 'Realized' ? 'selected' : '' }}>Réalisé</option>
                    <option value="Canceled" {{ $appointment->status == 'Canceled' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                <button type="submit" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                    </svg>
                    Mettre à jour le Rendez-vous
                </button>
                <a href="{{ route('appointments.index') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Retour à la Liste
                </a>
            </div>
        </form>
    </div>
</div>
@endsection