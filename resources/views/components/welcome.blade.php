<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
<div class="flex items-center justify-center flex-grow">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Bienvenue sur le système de gestion de produits</h1>
            
            @if(session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('clients.index') }}" method="GET" class="mb-4">
                <button type="submit" aria-label="Accéder à la liste des clients" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300 transform hover:scale-105 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-opacity-50">
                    Accéder à la Liste des Clients
                </button>
            </form>

            <form action="{{ route('appointments.index') }}" method="GET" class="mb-4">
                <button type="submit" aria-label="Accéder aux rendez-vous" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300 transform hover:scale-105 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-opacity-50">
                    Accéder aux Rendez-vous
                </button>
            </form>

            <form action="{{ route('products.index') }}" method="GET" class="mb-4">
                <button type="submit" aria-label="Accéder à la liste des produits" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300 transform hover:scale-105 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-opacity-50">
                    Accéder à la Liste des Produits
                </button>
            </form>
             
            <form action="{{ route('orders.index') }}" method="GET" class="mb-4">
                <button type="submit" aria-label="Accéder à la liste des commandes" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300 transform hover:scale-105 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-opacity-50">
                    Accéder à la Liste des Commandes
                </button>
            </form>

            <form action="{{ route('invoices.index') }}" method="GET" class="mb-4">
                <button type="submit" aria-label="Accéder à la liste des factures" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300 transform hover:scale-105 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-opacity-50">
                    Accéder à la Liste des Factures
                </button>
            </form>
            @if(!Auth::user()->hasRole('Salesperson'))
            <form action="{{ route('users.index') }}" method="GET">
                <button type="submit" aria-label="Accéder à la liste des factures" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300 transform hover:scale-105 shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-opacity-50">
                    Gestion des commerciaux 
                </button>
            </form>
            @endif
        </div>
    </div>

    <p class="mt-6 text-center text-gray-600">
        &copy; {{ date('Y') }} Votre Société. Tous droits réservés.
    </p>
</div>
