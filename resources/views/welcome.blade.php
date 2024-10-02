<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Ajoutez votre CSS ici -->
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Bienvenue sur le système de gestion de produits</h1>
            
            <form action="{{ route('products.index') }}" method="GET">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition duration-200">
                    Accéder à la Liste des Produits
                </button>
            </form>
            </form>
        </div>
    </div>
</body>
</html>
