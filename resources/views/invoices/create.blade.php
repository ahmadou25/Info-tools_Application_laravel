@extends('invoices.layout')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Créer une Nouvelle Facture</h1>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        <!-- Sélection de la commande -->
        <div class="mb-4">
            <label for="order_id" class="block text-gray-700 font-medium">Commande</label>
            <select name="order_id" id="order_id" required class="block w-full p-2 border border-gray-300 rounded-md">
                <option value="">Sélectionnez une commande</option>
                @foreach($orders as $order)
                    <option value="{{ $order->order_id }}">{{ $order->order_id }}</option>
                @endforeach
            </select>
            @error('order_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date d'Émission -->
        <div class="mb-4">
            <label for="emission_date" class="block text-gray-700 font-medium">Date d'Émission</label>
            <input type="date" name="emission_date" id="emission_date" required class="block w-full p-2 border border-gray-300 rounded-md">
            @error('emission_date')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date de Paiement -->
        <div class="mb-4">
            <label for="payment_date" class="block text-gray-700 font-medium">Date de Paiement (facultatif)</label>
            <input type="date" name="payment_date" id="payment_date" class="block w-full p-2 border border-gray-300 rounded-md">
            @error('payment_date')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton Créer -->
        <div class="mb-4">
            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 focus:outline-none">
                Créer la Facture
            </button>
        </div>
    </form>

    <!-- Bouton Retour -->
    <div class="mt-6">
        <a href="{{ route('invoices.index') }}" class="w-full inline-block text-center px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700 focus:outline-none">
            Retour à la Liste des Factures
        </a>
    </div>
</div>
@endsection
