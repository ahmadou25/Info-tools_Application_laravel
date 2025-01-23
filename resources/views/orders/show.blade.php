@extends('orders.layout')

@section('content')
<div class="container mx-auto p-6 bg-gray-50 rounded shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Détails de la Commande #{{ $order->order_id }}</h1>

    <div class="bg-white p-4 rounded shadow-md">
        <ul class="space-y-4">
            <li><strong>Client:</strong> {{ $order->client->first_name }} {{ $order->client->last_name }}</li>
            <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}</li>
        </ul>

        <h2 class="text-xl font-semibold mt-6 mb-4">Produits</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="py-2 px-4 border-b">Produit</th>
                        <th class="py-2 px-4 border-b">Quantité</th>
                        <th class="py-2 px-4 border-b">Prix Unitaire</th>
                        <th class="py-2 px-4 border-b">Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->pivot->quantity }}</td>
                            <td class="py-2 px-4 border-b">{{ number_format($product->pivot->price, 2) }} €</td>
                            <td class="py-2 px-4 border-b">{{ number_format($product->pivot->quantity * $product->pivot->price, 2) }} €</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-100 font-semibold">
                        <td colspan="3" class="py-2 px-4 text-right border-b">Montant Total:</td>
                        <td class="py-2 px-4 border-b">{{ number_format($order->products->sum(fn($p) => $p->pivot->quantity * $p->pivot->price), 2) }} €</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-6 flex justify-between">
        <!-- Bouton Retour à la Liste -->
        <a href="{{ route('orders.index') }}" class="btn bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
            Retour à la Liste
        </a>

        <div class="flex space-x-4">
            <!-- Afficher le bouton Modifier uniquement si l'utilisateur a la permission -->
            @can('update', $order)
                <a href="{{ route('orders.edit', $order->order_id) }}" class="btn bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded">
                    Modifier la Commande
                </a>
            @endcan

            <!-- Afficher le bouton Supprimer uniquement si l'utilisateur a la permission -->
            @can('delete', $order)
                <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded" 
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">
                        Supprimer la Commande
                    </button>
                </form>
            @endcan
        </div>
    </div>
</div>
@endsection
