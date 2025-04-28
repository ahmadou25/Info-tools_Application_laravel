@extends('invoices.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">

    <!-- Bande bleue en haut -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 rounded-t-xl shadow-md max-w-5xl mx-auto">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-white">Créer une Nouvelle Facture</h2>
            <a href="{{ route('invoices.index') }}" class="flex items-center text-blue-200 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Retour aux factures
            </a>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="max-w-5xl mx-auto p-8 bg-white rounded-b-xl shadow-md">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Créer une Facture</h1>

        @if($errors->any())
            <div class="bg-red-50 border border-red-500 text-red-700 px-6 py-4 rounded mb-6 shadow-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('invoices.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Sélection de la commande -->
            <div class="mb-6">
                <label for="order_id" class="block text-sm font-medium text-gray-700 mb-1">Commande</label>
                <select name="order_id" id="order_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 text-sm" required>
                    <option value="">Sélectionner une commande</option>
                    @foreach($orders as $order)
                        <option value="{{ $order->order_id }}">N° de commande : {{ $order->order_id }}</option>
                    @endforeach
                </select>
                @error('order_id')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date d'Émission -->
            <div class="mb-6">
                <label for="emission_date" class="block text-sm font-medium text-gray-700 mb-1">Date d'Émission</label>
                <input type="date" name="emission_date" id="emission_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 text-sm" required>
                @error('emission_date')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date de Paiement -->
            <div class="mb-6">
                <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-1">Date de Paiement (facultatif)</label>
                <input type="date" name="payment_date" id="payment_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 text-sm">
                @error('payment_date')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bouton Créer -->
            <div class="mb-6">
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                    Créer la Facture
                </button>
            </div>
        </form>

        <!-- Retour -->
        <div class="mt-8 text-center">
            <a href="{{ route('invoices.index') }}" class="inline-block text-white bg-gray-500 hover:bg-gray-700 px-6 py-2 rounded-lg transition">
                Retour à la Liste des Factures
            </a>
        </div>
    </div>
</div>
@endsection
