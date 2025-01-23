@extends('invoices.layout')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-center">Facture N° {{ $invoice->invoice_id }}</h1>

    <div class="mb-6">
        <p class="font-semibold text-lg">
            Bonjour {{ $invoice->order->client ? $invoice->order->client->first_name . ' ' . $invoice->order->client->last_name : 'cher Client' }},
        </p>
        <p>Votre commande n° {{ $invoice->order->order_id }} a bien été enregistrée. Merci pour votre confiance.</p>
        <p class="text-sm text-gray-600">Pour toute question, veuillez contacter notre service client au <strong>09 74 75 01 74</strong>.</p>
    </div>

    <div class="border-t border-gray-300 mt-4 pt-4">
        <h2 class="text-lg font-semibold mb-4">Informations sur la commande</h2>
        <ul>
            <li><strong>N° de commande :</strong> {{ $invoice->order->order_id }}</li>
            <li><strong>Date de commande :</strong> {{ \Carbon\Carbon::parse($invoice->order->date)->format('d/m/Y') }}</li>
            <li><strong>Date d'émission :</strong> {{ \Carbon\Carbon::parse($invoice->emission_date)->format('d/m/Y') }}</li>
            <li><strong>Date de paiement :</strong> {{ $invoice->payment_date ? \Carbon\Carbon::parse($invoice->payment_date)->format('d/m/Y') : 'Non payé' }}</li>
            <li><strong>Adresse de facturation :</strong></li>
            <ul class="pl-6">
                <li>{{ $invoice->order->client->name ?? '' }}</li>
                <li>{{ $invoice->order->client->address ?? '' }}</li>
                <li>{{ $invoice->order->client->postal_code ?? '' }} {{ $invoice->order->client->city ?? '' }}</li>
                <li>{{ $invoice->order->client->country ?? '' }}</li>
            </ul>
        </ul>
    </div>

    <div class="border-t border-gray-300 mt-4 pt-4">
        <h2 class="text-lg font-semibold mb-4">Détail des articles</h2>
        <table class="w-full text-left border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Article</th>
                    <th class="border border-gray-300 px-4 py-2">Prix Unitaire (€)</th>
                    <th class="border border-gray-300 px-4 py-2">Quantité</th>
                    <th class="border border-gray-300 px-4 py-2">Total (€)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->order->products as $product)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ number_format($product->pivot->price, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ $product->pivot->quantity }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="border-t border-gray-300 mt-4 pt-4">
        <h2 class="text-lg font-semibold mb-4">Résumé du paiement</h2>
        <ul>
            <li><strong>Sous-total TTC :</strong> {{ number_format($invoice->order->products->sum(fn($p) => $p->pivot->price * $p->pivot->quantity), 2) }} €</li>
            <li><strong>Frais de livraison :</strong> {{ number_format($invoice->order->delivery_fee ?? 0, 2) }} €</li>
            <li><strong>Montant total HT :</strong> {{ number_format($invoice->total_amount / 1.2, 2) }} €</li>
            <li><strong>Montant total TTC :</strong> {{ number_format($invoice->total_amount, 2) }} €</li>
        </ul>
    </div>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">Les commandes spéciales clients ne sont ni reprises, ni échangées.</p>
        <p class="font-semibold">Merci pour votre commande !</p>
    </div>

    <div class="mt-6 text-center flex justify-center gap-4">
        <!-- Bouton pour imprimer -->
        <button onclick="window.print()" class="px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-500">
            Imprimer la Facture
        </button>

        <!-- Bouton pour retourner à la liste -->
        <a href="{{ route('invoices.index') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">
            Retour à la liste des factures
        </a>
    </div>
</div>
@endsection
