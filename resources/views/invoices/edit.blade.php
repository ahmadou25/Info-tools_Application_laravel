@extends('invoices.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <!-- Bande bleue en haut -->
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 px-6 py-4 rounded-t-xl shadow-md max-w-3xl mx-auto">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-white">Modifier la Facture N° : {{ $invoice->invoice_id }}</h2>
            <a href="{{ route('invoices.index') }}" class="flex items-center text-indigo-200 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Retour aux Factures
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="max-w-3xl mx-auto p-8 bg-white rounded-b-xl shadow-md">
        <form action="{{ route('invoices.update', $invoice->invoice_id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Commande -->
            <div>
                <label for="order_id" class="block text-sm font-medium text-gray-700 mb-1">Commande</label>
                <select name="order_id" id="order_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 text-sm">
                    <option value="">Sélectionnez une commande</option>
                    @foreach($orders as $order)
                        <option value="{{ $order->order_id }}" {{ $order->order_id == $invoice->order_id ? 'selected' : '' }}>
                            Commande N° {{ $order->order_id }} - {{ $order->client->first_name ?? 'Nom' }} {{ $order->client->last_name ?? 'Inconnu' }}
                        </option>
                    @endforeach
                </select>
                @error('order_id')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date d'Émission -->
            <div>
                <label for="emission_date" class="block text-sm font-medium text-gray-700 mb-1">Date d'Émission</label>
                <input type="date" name="emission_date" id="emission_date" value="{{ $invoice->emission_date }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 text-sm">
                @error('emission_date')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date de Paiement -->
            <div>
                <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-1">Date de Paiement (facultatif)</label>
                <input type="date" name="payment_date" id="payment_date" value="{{ $invoice->payment_date }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3 text-sm">
                @error('payment_date')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bouton -->
            <div class="flex justify-between items-center">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-md shadow-md transition">
                    Mettre à Jour la Facture
                </button>
                <a href="{{ route('invoices.index') }}" class="inline-block text-white bg-gray-500 hover:bg-gray-700 px-5 py-2 rounded-lg transition">
                    Retour à la Liste
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
