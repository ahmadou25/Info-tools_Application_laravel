@extends('invoices.layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Liste des Factures</h1>
            <div>
                <!-- Bouton Créer une Nouvelle Facture : visible uniquement si l'utilisateur est autorisé -->
                @can('create', App\Models\Invoice::class)
                    <a class="btn btn-success bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('invoices.create') }}">
                        <i class="fa fa-plus-circle"></i> Créer une Nouvelle Facture
                    </a>
                @endcan

                <!-- Bouton Retour à l'Accueil (toujours visible) -->
                <a class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" href="{{ route('dashboard') }}">
                    <i class="fa fa-home"></i> Retour à l'Accueil
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Numéro de Facture</th>
                    <th class="border px-4 py-2">Commande</th>
                    <th class="border px-4 py-2">Montant Total</th>
                    <th class="border px-4 py-2">Date d'Émission</th>
                    <th class="border px-4 py-2">Date de Paiement</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $invoice->invoice_id }}</td>
                        <td class="border px-4 py-2">{{ $invoice->order->order_id }}</td>
                        <td class="border px-4 py-2">{{ number_format($invoice->total_amount, 2) }} €</td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($invoice->emission_date)->format('d/m/Y') }}</td>
                        <td class="border px-4 py-2">{{ $invoice->payment_date ? \Carbon\Carbon::parse($invoice->payment_date)->format('d/m/Y') : 'Non payé' }}</td>
                        <td class="border px-4 py-2">
                            <div class="flex justify-center">
                                <!-- Bouton Détails (toujours visible) -->
                                <a href="{{ route('invoices.show', $invoice->invoice_id) }}" class="btn btn-info bg-blue-300 hover:bg-blue-400 text-white px-3 py-1 rounded mr-2">Détails</a>

                                <!-- Bouton Modifier : visible uniquement si l'utilisateur est autorisé -->
                                @can('update', $invoice)
                                    <a href="{{ route('invoices.edit', $invoice->invoice_id) }}" class="btn btn-warning bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded mr-2">Modifier</a>
                                @endcan

                                <!-- Bouton Supprimer : visible uniquement si l'utilisateur est autorisé -->
                                @can('delete', $invoice)
                                    <form action="{{ route('invoices.destroy', $invoice->invoice_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?')">Supprimer</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
