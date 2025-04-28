@extends('clients.layout')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- En-tête avec fond coloré -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white">Détails du Client</h1>
                    <p class="text-blue-100 mt-1">Numéro d'identification : {{ $client->id }}</p>
                </div>
                <div class="bg-white/20 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Carte d'information du client -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Section principale -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">{{ $client->first_name }} {{ $client->last_name }}</h2>
                            <p class="text-gray-600">{{ $client->type == 'client' ? 'Client' : 'Prospect' }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-medium text-gray-700 mb-2">Coordonnées</h3>
                        <div class="space-y-2">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-700">{{ $client->email }}</span>
                            </div>
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-gray-700">{{ $client->phone }}</span>
                            </div>
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-700">{{ $client->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section secondaire (statistiques ou autres infos) -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="font-medium text-gray-700 mb-3">Activité récente</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-600">Dernier contact</span>
                                <span class="text-sm text-gray-500">2 jours</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-600">Engagement</span>
                                <span class="text-sm text-gray-500">Moyen</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: 50%"></div>
                            </div>
                        </div>
                        <div class="pt-2">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-semibold">Client depuis {{ $client->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Historique -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Historique</h3>
                
                <!-- Sous-section Rendez-vous -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="text-md font-medium text-gray-700">Rendez-vous à venir</h4>
                        <a href="{{ route('appointments.create', ['client_id' => $client->id]) }}" class="text-sm text-blue-600 hover:text-blue-800">+ Ajouter un rendez-vous</a>
                    </div>
                    
                    @php
                        $upcomingAppointments = $client->appointments->where('date_time', '>=', now())->sortBy('date_time');
                        $pastAppointments = $client->appointments->where('date_time', '<', now())->sortByDesc('date_time');
                    @endphp
                    
                    @if($upcomingAppointments->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden mb-6">
                        <div class="divide-y divide-gray-200">
                            @foreach($upcomingAppointments as $appointment)
                            <div class="p-4 hover:bg-gray-50">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="font-medium">{{ $appointment->title }}</p>
                                        <p class="text-sm text-gray-600">
                                            @if($appointment->date_time)
                                                {{ $appointment->date_time->format('d/m/Y H:i') }}
                                                <span class="text-green-600 ml-2">(À venir)</span>
                                            @else
                                                <span class="text-red-500">Date non définie</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @if($appointment->notes)
                                    <p class="mt-2 text-sm text-gray-600">{{ $appointment->notes }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-500 mb-6">
                        Aucun rendez-vous à venir
                    </div>
                    @endif

                    <h4 class="text-md font-medium text-gray-700 mb-3">Rendez-vous passés</h4>
                    
                    @if($pastAppointments->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <div class="divide-y divide-gray-200">
                            @foreach($pastAppointments as $appointment)
                            <div class="p-4 hover:bg-gray-50">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="font-medium">{{ $appointment->title }}</p>
                                        <p class="text-sm text-gray-600">
                                            @if($appointment->date_time)
                                                {{ $appointment->date_time->format('d/m/Y H:i') }}
                                                <span class="text-gray-500 ml-2">(Passé)</span>
                                            @else
                                                <span class="text-red-500">Date non définie</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @if($appointment->notes)
                                    <p class="mt-2 text-sm text-gray-600">{{ $appointment->notes }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-500">
                        Aucun rendez-vous passé
                    </div>
                    @endif
                </div>
                
                <!-- Sous-section Commandes -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="text-md font-medium text-gray-700">Commandes</h4>
                        <a href="{{ route('orders.create', ['client_id' => $client->id]) }}" class="text-sm text-blue-600 hover:text-blue-800">+ Ajouter une commande</a>
                    </div>
                    
                    @if($client->orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Référence</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($client->orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800">{{ $order->order_id }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($order->date)
                                        {{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}
                                        @else
                                            <span class="text-red-500">Date non définie</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($order->amount, 2, ',', ' ') }} €</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-500">
                        Aucune commande enregistrée
                    </div>
                    @endif
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex flex-wrap gap-3 justify-end border-t border-gray-200 pt-6">
                <a href="{{ route('clients.index') }}" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
                
                <a href="{{ route('clients.edit', $client->id) }}" class="flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Modifier
                </a>

                @if(!Auth::user()->hasRole('Salesperson'))
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')" class="flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Supprimer
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection