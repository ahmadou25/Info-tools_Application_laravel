<div class="min-h-screen bg-gray-50 p-6 lg:p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header avec message de bienvenue -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Bonjour, {{ Auth::user()->name }}</h1>
                    <p class="text-gray-500 mt-1">Bienvenue sur votre espace de gestion</p>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-2">
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium">
                        {{ Auth::user()->role }}
                    </span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                        Connecté
                    </span>
                </div>
            </div>
        </div>

        <!-- Notification de succès -->
        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start">
            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div class="text-green-700">{{ session('success') }}</div>
        </div>
        @endif

        <!-- Cartes de fonctionnalités -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Clients -->
            <a href="{{ route('clients.index') }}" class="group">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-indigo-200 hover:shadow-md transition-all duration-300 h-full">
                    <div class="flex items-center mb-4">
                        <div class="bg-indigo-50 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600">Gestion des Clients</h3>
                    </div>
                    <p class="text-gray-500">Consultez et gérez votre portefeuille clients</p>
                    <div class="mt-4 text-indigo-600 flex items-center">
                        <span>Accéder</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Rendez-vous -->
            <a href="{{ route('appointments.index') }}" class="group">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-blue-200 hover:shadow-md transition-all duration-300 h-full">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-50 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">Rendez-vous</h3>
                    </div>
                    <p class="text-gray-500">Planifiez et suivez vos rencontres commerciales</p>
                    <div class="mt-4 text-blue-600 flex items-center">
                        <span>Accéder</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Produits -->
            <a href="{{ route('products.index') }}" class="group">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-green-200 hover:shadow-md transition-all duration-300 h-full">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-50 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-green-600">Gestion des Produits</h3>
                    </div>
                    <p class="text-gray-500">Consultez et gérez votre catalogue produits</p>
                    <div class="mt-4 text-green-600 flex items-center">
                        <span>Accéder</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Commandes -->
            <a href="{{ route('orders.index') }}" class="group">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-purple-200 hover:shadow-md transition-all duration-300 h-full">
                    <div class="flex items-center mb-4">
                        <div class="bg-purple-50 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-purple-600">Commandes</h3>
                    </div>
                    <p class="text-gray-500">Suivez et traitez les commandes clients</p>
                    <div class="mt-4 text-purple-600 flex items-center">
                        <span>Accéder</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Factures -->
            <a href="{{ route('invoices.index') }}" class="group">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-red-200 hover:shadow-md transition-all duration-300 h-full">
                    <div class="flex items-center mb-4">
                        <div class="bg-red-50 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-red-600">Factures</h3>
                    </div>
                    <p class="text-gray-500">Générez et consultez vos factures</p>
                    <div class="mt-4 text-red-600 flex items-center">
                        <span>Accéder</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Gestion des commerciaux (conditionnel) -->
            @if(!Auth::user()->hasRole('Salesperson'))
            <a href="{{ route('users.index') }}" class="group">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-amber-200 hover:shadow-md transition-all duration-300 h-full">
                    <div class="flex items-center mb-4">
                        <div class="bg-amber-50 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-amber-600">Équipe Commerciale</h3>
                    </div>
                    <p class="text-gray-500">Gérez vos commerciaux et leurs performances</p>
                    <div class="mt-4 text-amber-600 flex items-center">
                        <span>Accéder</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endif
        </div>

        <!-- Footer -->
        <div class="mt-12 text-center text-gray-400 text-sm">
            <p>&copy; {{ date('Y') }} INFO-TOOLS. Tous droits réservés.</p>
            <p class="mt-1">Version 2.1.0</p>
        </div>
    </div>
</div>