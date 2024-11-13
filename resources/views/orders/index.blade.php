@extends('orders.layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Liste des Commandes</h2>
            <div class="flex space-x-2">
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('dashboard') }}">
                    <i class="fa fa-home"></i> Retour à l'Accueil
                </a>
                {{-- Afficher le bouton "Ajouter une Commande" pour les Managers et Salespersons --}}
                @can('create', App\Models\Order::class)
                    <a class="btn btn-success bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('orders.create') }}">
                        <i class="fa fa-plus-circle"></i> Ajouter une Commande
                    </a>
                @elseif(auth()->user()->hasRole('Salesperson'))
                    <a class="btn btn-success bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('orders.create') }}">
                        <i class="fa fa-plus-circle"></i> Ajouter une Commande
                    </a>
                @endcan
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-green-500 text-white p-3 rounded mb-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('appointments.index') }}" method="GET" class="mb-4">
            <label for="client_id" class="block mb-2">Filtrer par Client:</label>
            <select name="client_id" id="client_id" class="form-select mb-3">
                <option value="">Tous les Clients</option>
                @foreach($clients as $client)
                    <option value="{{ $client->client_id }}">{{ $client->first_name }} {{ $client->last_name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Filtrer</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="w-full bg-gray-100 text-left">
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Client</th>
                        <th class="py-2 px-4 border-b">Produit</th>
                        <th class="py-2 px-4 border-b">Quantité</th>
                        <th class="py-2 px-4 border-b">Date</th>
                        <th class="py-2 px-4 border-b">Montant</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $order->order_id }}</td>
                            <td class="py-2 px-4 border-b">{{ $order->client->first_name }} {{ $order->client->last_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $order->product->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $order->quantity }}</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y') }}</td>
                            <td class="py-2 px-4 border-b">{{ number_format($order->amount, 2) }} €</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center">
                                    <a class="btn btn-info bg-blue-300 hover:bg-blue-400 text-white px-3 py-1 rounded mr-2" href="{{ route('orders.show', $order->order_id) }}">Voir</a>
                                    @can('update', $order)
                                        <a class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded mr-2" href="{{ route('orders.edit', $order->order_id) }}">Modifier</a>
                                    @endcan
                                    @can('delete', $order)
                                        <form action="{{ route('orders.destroy', $order->order_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">Supprimer</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
