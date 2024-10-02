@extends('invoices.layout')

@section('content')
<div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Liste des Factures</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('invoices.create') }}" class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">Créer une Nouvelle Facture</a>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Commande</th>
                    <th class="border px-4 py-2">Montant Total</th>
                    <th class="border px-4 py-2">Date d'Émission</th>
                    <th class="border px-4 py-2">Date de Paiement</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td class="border px-4 py-2">{{ $invoice->invoice_id }}</td>
                        <td class="border px-4 py-2">{{ $invoice->order->order_id }}</td>
                        <td class="border px-4 py-2">{{ number_format($invoice->total_amount, 2) }} €</td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($invoice->emission_date)->format('d/m/Y') }}</td>
                        <td class="border px-4 py-2">{{ $invoice->payment_date ? \Carbon\Carbon::parse($invoice->payment_date)->format('d/m/Y') : 'Non payé' }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('invoices.show', $invoice->invoice_id) }}" class="text-blue-500">Voir</a>
                            <a href="{{ route('invoices.edit', $invoice->invoice_id) }}" class="text-yellow-500">Modifier</a>
                            <form action="{{ route('invoices.destroy', $invoice->invoice_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
