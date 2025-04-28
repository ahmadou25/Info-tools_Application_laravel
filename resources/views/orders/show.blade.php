@extends('orders.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <!-- En-tête -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Commande N° : {{ $order->order_id }}</h2>
                    <a href="{{ route('orders.index') }}" class="flex items-center text-blue-200 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Retour aux commandes
                    </a>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="p-6">
                <!-- Section Client -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations Client</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Carte Identité -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Identité</h4>
                            <div class="space-y-1">
                                <p class="text-gray-900">
                                    <span class="font-medium">Nom :</span> {{ $order->client->last_name }}
                                </p>
                                <p class="text-gray-900">
                                    <span class="font-medium">Prénom :</span> {{ $order->client->first_name }}
                                </p>
                                <p class="text-gray-900">
                                    <span class="font-medium">Email :</span> 
                                    <a href="mailto:{{ $order->client->email }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $order->client->email ?? 'Non renseigné' }}
                                    </a>
                                </p>
                                <p class="text-gray-900">
                                    <span class="font-medium">Téléphone :</span> 
                                    {{ $order->client->phone ?? 'Non renseigné' }}
                                </p>
                            </div>
                        </div>

                        <!-- Carte Adresse -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Adresse</h4>
                            <div class="space-y-1">
                                @if($order->client->address)
                                    <p class="text-gray-900">{{ $order->client->address }}</p>
                                    <p class="text-gray-900">
                                        {{ $order->client->postal_code }} {{ $order->client->city }}
                                    </p>
                                    <p class="text-gray-900">
                                        {{ $order->client->country ?? '' }}
                                    </p>
                                @else
                                    <p class="text-gray-500 italic">Adresse non renseignée</p>
                                @endif
                            </div>
                        </div>

                        <!-- Carte Informations complémentaires -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Détails</h4>
                            <div class="space-y-1">
                                <p class="text-gray-900">
                                    <span class="font-medium">Date de naissance :</span> 
                                    {{ $order->client->birth_date ? \Carbon\Carbon::parse($order->client->birth_date)->isoFormat('LL') : 'Non renseignée' }}
                                </p>
                                <p class="text-gray-900">
                                    <span class="font-medium">Client depuis :</span> 
                                    {{ \Carbon\Carbon::parse($order->client->created_at)->isoFormat('LL') }}
                                </p>
                                <p class="text-gray-900">
                                    <span class="font-medium">Commandes :</span> 
                                    {{ $order->client->orders_count ?? 0 }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Commande -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Carte Date et Statut -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Détails de la commande</h3>
                        <div class="space-y-2">
                            <p class="text-gray-900">
                                <span class="font-medium">Date :</span> 
                                {{ \Carbon\Carbon::parse($order->date)->isoFormat('LL') }}
                                <span class="text-gray-500 text-sm">({{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }})</span>
                            </p>
                            <p class="text-gray-900">
                                <span class="font-medium">Statut :</span> 
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                       ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                                       'bg-gray-100 text-gray-800')) }}">
                                    {{ ucfirst($order->status ?? 'non spécifié') }}
                                </span>
                            </p>
                            <p class="text-gray-900">
                                <span class="font-medium">Méthode de paiement :</span> 
                                {{ $order->payment_method ?? 'Non spécifiée' }}
                            </p>
                            @if($order->user)
                            <p class="text-gray-900">
                                <span class="font-medium">Commercial :</span> 
                                {{ $order->user->first_name }} {{ $order->user->last_name }}
                                <span class="text-gray-500 text-sm">({{ $order->user->email }})</span>
                            </p>
                            @endif
                        </div>
                    </div>

                    <!-- Carte Livraison -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Livraison</h3>
                        <div class="space-y-2">
                            <p class="text-gray-900">
                                <span class="font-medium">Mode :</span> 
                                {{ $order->shipping_method ?? 'Standard' }}
                            </p>
                            <p class="text-gray-900">
                                <span class="font-medium">Adresse :</span> 
                                @if($order->shipping_address)
                                    {{ $order->shipping_address }}
                                @else
                                    <span class="text-gray-500 italic">Même que le client</span>
                                @endif
                            </p>
                            <p class="text-gray-900">
                                <span class="font-medium">Frais :</span> 
                                {{ $order->shipping_cost ? number_format($order->shipping_cost, 2).' €' : 'Gratuit' }}
                            </p>
                            @if($order->notes)
                            <p class="text-gray-900">
                                <span class="font-medium">Notes :</span> 
                                <span class="text-gray-600 italic">{{ $order->notes }}</span>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Liste des produits -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Produits commandés</h3>
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Produit</th>
                                    <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">Quantité</th>
                                    <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">Prix unitaire</th>
                                    <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($order->products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                        {{ $product->name }}
                                        @if($product->category)
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $product->category }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-right">
                                        {{ $product->pivot->quantity }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-right">
                                        {{ number_format($product->pivot->price, 2) }} €
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 text-right">
                                        {{ number_format($product->pivot->quantity * $product->pivot->price, 2) }} €
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                @if($order->shipping_cost > 0)
                                <tr>
                                    <td colspan="3" class="py-3 pl-4 pr-3 text-right text-sm font-semibold text-gray-900">Frais de livraison</td>
                                    <td class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                                        {{ number_format($order->shipping_cost, 2) }} €
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="py-3 pl-4 pr-3 text-right text-sm font-semibold text-gray-900">Total</td>
                                    <td class="px-3 py-3 text-right text-sm font-semibold text-gray-900">
                                        {{ number_format($order->products->sum(fn($p) => $p->pivot->quantity * $p->pivot->price) + $order->shipping_cost, 2) }} €
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col-reverse sm:flex-row justify-between items-center pt-6 border-t border-gray-200 space-y-4 sm:space-y-0">
                    <div class="w-full sm:w-auto">
                        <a href="{{ route('orders.index') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Retour aux commandes
                        </a>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3 w-full sm:w-auto">
                        @can('update', $order)
                        <a href="{{ route('orders.edit', $order->order_id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Modifier
                        </a>
                        @endcan

                        @can('delete', $order)
                        <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Supprimer
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection