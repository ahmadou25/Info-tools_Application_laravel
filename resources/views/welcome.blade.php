<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Ajoutez des styles personnalisés si nécessaire */
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Bienvenue sur le système de gestion de produits</h1>
            
            <form action="{{ route('products.index') }}" method="GET" class="mb-4">
                <button type="submit" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition duration-300 transform hover:scale-105 shadow-md">
                    Accéder à la Liste des Produits
                </button>
            </form>
             
            <form action="{{ route('orders.index') }}" method="GET">
                <button type="submit" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition duration-300 transform hover:scale-105 shadow-md">
                    Accéder à la Liste des Commandes
                </button>
            </form>

            <form action="{{ route('invoices.index') }}" method="GET">
                <button type="submit" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition duration-300 transform hover:scale-105 shadow-md">
                    Accéder à la Liste des Commandes
                </button>
            </form>

            <p class="mt-6 text-center text-gray-600">
                &copy; {{ date('Y') }} Votre Société. Tous droits réservés.
            </p>
        </div>
    </div>
</body>
</html>
