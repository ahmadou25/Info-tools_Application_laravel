@extends('users.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Carte principale -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- En-tête avec dégradé -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-5 sm:px-8 sm:py-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Détails du Commercial N° : {{ $user->id }}</h2>
                        <p class="mt-1 text-blue-100">Informations complètes et statistiques de performance</p>
                    </div>
                    <a href="{{ route('users.index') }}" 
                       class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 border border-blue-300 rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 bg-opacity-20 hover:bg-opacity-30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-200 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Retour à la liste
                    </a>
                </div>
            </div>

            <!-- Contenu -->
            <div class="px-6 py-8 sm:px-8 sm:py-10">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Section Informations personnelles -->
                    <div class="lg:col-span-1 bg-gray-50 p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Informations Personnelles</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nom complet</p>
                                <p class="text-lg font-semibold text-gray-800">{{ $user->first_name }} {{ $user->last_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-lg font-semibold text-blue-600">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Rôle</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 capitalize">
                                    {{ $user->role }}
                                </span>
                            </div>
                            @if($user->role === 'Salesperson' && $user->manager)
                            <div>
                                <p class="text-sm font-medium text-gray-500">Manager</p>
                                <p class="text-lg font-semibold text-gray-800">
                                    <a href="{{ route('users.show', $user->manager->id) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $user->manager->first_name }} {{ $user->manager->last_name }}
                                    </a>
                                </p>
                            </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-gray-500">Adresse</p>
                                <p class="text-gray-800">{{ $user->address ?? 'Non renseignée' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Téléphone</p>
                                <p class="text-gray-800">{{ $user->phone_number ?? 'Non renseigné' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Date de début</p>
                                <p class="text-gray-800">{{ $user->start_date ? \Carbon\Carbon::parse($user->start_date)->format('d/m/Y') : 'Non renseignée' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section Statistiques -->
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-6">Statistiques de Performance</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <!-- Carte Commandes -->
                            <div class="bg-white border border-green-200 rounded-lg shadow-sm overflow-hidden">
                                <div class="p-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="bg-green-100 p-3 rounded-full">
                                                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Commandes réalisées</dt>
                                                <dd>
                                                    <div class="text-3xl font-semibold text-gray-900">{{ $orders_count ?? 0 }}</div>
                                                    <div class="text-sm text-green-600 mt-1">
                                                        <span class="inline-flex items-center">
                                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                                                            </svg>
                                                            {{ $orders_growth ?? 0 }}% ce mois-ci
                                                        </span>
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Carte Rendez-vous -->
                            <div class="bg-white border border-purple-200 rounded-lg shadow-sm overflow-hidden">
                                <div class="p-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="bg-purple-100 p-3 rounded-full">
                                                <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Rendez-vous clients</dt>
                                                <dd>
                                                    <div class="text-3xl font-semibold text-gray-900">{{ $appointments_count ?? 0 }}</div>
                                                    <div class="text-sm text-purple-600 mt-1">
                                                        <span class="inline-flex items-center">
                                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                                                            </svg>
                                                            {{ $appointments_growth ?? 0 }}% ce mois-ci
                                                        </span>
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Graphique de performance -->
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <h4 class="text-md font-medium text-gray-700 mb-4">Performance mensuelle</h4>
                            <div class="h-64">
                                <canvas id="performanceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('users.edit', $user->id) }}" 
                       class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Modifier
                    </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commercial ?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour le graphique Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('performanceChart').getContext('2d');
        
        // Données du graphique (à remplacer par vos données dynamiques)
        const performanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [
                    {
                        label: 'Commandes',
                        data: [12, 19, 15, 27, 22, 18, 25, 20, 30, 28, 32, 40],
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Rendez-vous',
                        data: [8, 12, 10, 15, 14, 10, 18, 15, 20, 22, 25, 30],
                        borderColor: '#8B5CF6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endsection