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
            
            <form action="{{ route('product.index') }}" method="GET">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition duration-200">
                    Accéder à la Liste des Produits
                </button>
            </form>

            <form action="{{ route('product.create') }}" method="GET" class="mt-2">
                <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-500 transition duration-200">
                    Ajouter un Produit
                </button>
            </form>

            <form action="{{ route('product.edit', ['product' => 1]) }}" method="GET" class="mt-2"> <!-- Remplacez 1 par un ID valide ou gérez-le dynamiquement -->
                <button type="submit" class="w-full px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 transition duration-200">
                    Modifier un Produit
                </button>
            </form>

            <form action="{{ route('product.destroy', ['product' => 1]) }}" method="POST" class="mt-2"> <!-- Remplacez 1 par un ID valide -->
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500 transition duration-200" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                    Supprimer un Produit
                </button>
            </form>
        </div>
    </div>
</body>
</html>
