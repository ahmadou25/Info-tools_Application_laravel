@extends('invoices.layout')

@section('content')
<div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Détails de la Facture #{{ $invoice->invoice_id }}</h1>

        <div class="mb-4">
            <strong>Commande:</strong> {{ $invoice->order->order_id }}<br>
            <strong>Montant Total:</strong> {{ number_format($invoice->total_amount, 2) }} €<br>
            <strong>Date d'Émission:</strong> {{ \Carbon\Carbon::parse($invoice->emission_date)->format('d/m/Y') }}<br>
            <strong>Date de Paiement:</strong> {{ $invoice->payment_date ? \Carbon\Carbon::parse($invoice->payment_date)->format('d/m/Y') : 'Non payé' }}<br>
        </div>

        <a href="{{ route('invoices.index') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">Retour à la Liste des Factures</a>
    </div>
@endsection
