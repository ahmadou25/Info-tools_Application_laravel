@extends('invoices.layout')

@section('content')
<div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Créer une Nouvelle Facture</h1>

        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="order_id" class="block text-gray-700">Commande</label>
                <select name="order_id" id="order_id" required class="block w-full p-2 border rounded">
                    <option value="">Sélectionnez une commande</option>
                    @foreach($orders as $order)
                        <option value="{{ $order->order_id }}">{{ $order->order_id }}</option>
                    @endforeach
                </select>
                @error('order_id')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="emission_date" class="block text-gray-700">Date d'Émission</label>
                <input type="date" name="emission_date" id="emission_date" required class="block w-full p-2 border rounded">
                @error('emission_date')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="payment_date" class="block text-gray-700">Date de Paiement (facultatif)</label>
                <input type="date" name="payment_date" id="payment_date" class="block w-full p-2 border rounded">
                @error('payment_date')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">Créer la Facture</button>
        </form>
    </div>
@endsection
