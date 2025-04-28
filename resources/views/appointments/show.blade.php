@extends('appointments.layout')

@section('content')
<div class="container mx-auto p-6 max-w-5xl">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- En-tête avec bouton de retour -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">Détails du Rendez-vous</h1>
                    <p class="text-blue-100 mt-1">Numéro : {{ $appointment->appointment_id }}</p>
                </div>
                <a href="{{ route('appointments.index') }}" class="flex items-center text-blue-200 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Retour à la liste
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
            <!-- Section Rendez-vous -->
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-gray-50 rounded-lg p-5 shadow-sm border border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Informations du Rendez-vous</h2>
                    
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Date et Heure</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($appointment->date_time)->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Lieu</p>
                                <p class="font-medium">{{ $appointment->location }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Statut</p>
                                <p class="font-medium">
                                    <span class="px-2 py-1 rounded-full text-xs 
                                        {{ $appointment->status == 'Planned' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $appointment->status == 'Realized' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $appointment->status == 'Canceled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ $appointment->status }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes supplémentaires (exemple) -->
                <div class="bg-gray-50 rounded-lg p-5 shadow-sm border border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Notes</h2>
                    <p class="text-gray-600">{{ $appointment->notes ?? 'Aucune note pour ce rendez-vous' }}</p>
                </div>
            </div>

            <!-- Section Client -->
            <div class="space-y-4">
                <div class="bg-gray-50 rounded-lg p-5 shadow-sm border border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Informations du Client</h2>
                    
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 text-blue-800 rounded-full w-12 h-12 flex items-center justify-center mr-3">
                            <span class="text-lg font-semibold">{{ substr($appointment->client->first_name, 0, 1) }}{{ substr($appointment->client->last_name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="font-semibold">{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</h3>
                            <p class="text-sm text-gray-500">Client depuis {{ \Carbon\Carbon::parse($appointment->client->created_at)->format('m/Y') }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">{{ $appointment->client->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Téléphone</p>
                                <p class="font-medium">{{ $appointment->client->phone ?? 'Non renseigné' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Adresse</p>
                                <p class="font-medium">
                                    {{ $appointment->client->address ?? 'Non renseignée' }}<br>
                                    @if($appointment->client->postal_code && $appointment->client->city)
                                        {{ $appointment->client->postal_code }}, {{ $appointment->client->city }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-50 rounded-lg p-5 shadow-sm border border-gray-100 space-y-3">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2 pb-2 border-b border-gray-200">Actions</h2>
                    
                    <a href="{{ route('appointments.edit', $appointment->appointment_id) }}" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Modifier le rendez-vous
                    </a>

                    @auth
                        @if(auth()->user()->role === 'Manager')
                            <form action="{{ route('appointments.destroy', $appointment->appointment_id) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Supprimer le rendez-vous
                                </button>
                            </form>
                        @endif
                    @endauth

                    <a href="{{ route('clients.show', $appointment->client->id) }}" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        Voir la fiche client
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection