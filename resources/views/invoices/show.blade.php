@extends('invoices.layout')

@section('content')
<!-- En-tête coloré avec la même largeur -->
<div class="container mx-auto px-6 print:px-0 max-w-4xl">
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-t-lg shadow-md p-6 mb-6 print:mb-2">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0 flex items-center">
                <img src="{{ asset('images/infotools1.png') }}" alt="Company Logo" class="h-16 mr-4">
                <div class="text-white">
                    <h1 class="text-2xl font-bold">INFO-TOOLS</h1>
                    <div class="text-blue-100 text-sm">
                        <p>3 Place de Mathias, Chalon-sur-Saône 71100</p>
                        <p>infotools.contact@gmail.com - 09 74 75 01 74</p>
                        <p>SIRET : 08250825555521 - TVA : FRXX999999999</p>
                    </div>
                </div>
            </div>
            <div class="text-right text-white">
                <h2 class="text-2xl font-bold">FACTURE</h2>
                <p class="text-blue-100">N° {{ $invoice->invoice_id }}</p>
                @if(!$invoice->payment_date)
                    <span class="inline-block mt-2 px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                        NON PAYÉE
                    </span>
                @else
                    <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                        PAYÉE LE {{ \Carbon\Carbon::parse($invoice->payment_date)->format('d/m/Y') }}
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-4xl print:bg-white print:shadow-none print:p-0 print:max-w-full">    <!-- Client & Invoice Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <!-- Client Info -->
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-3">CLIENT</h3>
            <address class="not-italic">
                <p class="font-medium"> Nom et prenom : {{ $invoice->order->client->first_name . ' ' . $invoice->order->client->last_name ?? '' }}</p>
                <p>Adresse : {{ $invoice->order->client->address ?? '' }}</p>
                <!-- <p>{{ $invoice->order->client->postal_code ?? '' }} {{ $invoice->order->client->city ?? '' }}</p> -->
                <p>Email : {{ $invoice->order->client->email ?? '' }}</p>
                <p>Téléphone : {{ $invoice->order->client->phone ?? '' }}</p>
                @if($invoice->order->client->vat_number ?? false)
                    <p class="mt-2">TVA: {{ $invoice->order->client->vat_number }}</p>
                @endif
            </address>
        </div>
        
        <!-- Invoice Info -->
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-3">FACTURE</h3>
            <div class="space-y-2">
                <p><span class="font-medium">Date d'émission:</span> {{ \Carbon\Carbon::parse($invoice->emission_date)->format('d/m/Y') }}</p>
                <p><span class="font-medium">Date d'échéance:</span> {{ \Carbon\Carbon::parse($invoice->emission_date)->addDays(30)->format('d/m/Y') }}</p>
                <p><span class="font-medium">Référence commande:</span> {{ $invoice->order->order_id }}</p>
                <p><span class="font-medium">Mode de paiement:</span> {{ $invoice->payment_method ?? 'Non spécifié' }}</p>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="mb-8">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-left">
                    <th class="p-3 border border-gray-300 font-medium">Description</th>
                    <th class="p-3 border border-gray-300 font-medium text-right">Prix Unitaire HT</th>
                    <th class="p-3 border border-gray-300 font-medium text-right">TVA</th>
                    <th class="p-3 border border-gray-300 font-medium text-right">Quantité</th>
                    <th class="p-3 border border-gray-300 font-medium text-right">Total HT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->order->products as $product)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="p-3 border border-gray-300">{{ $product->name }}</td>
                    <td class="p-3 border border-gray-300 text-right">{{ number_format($product->pivot->price / 1.2, 2) }} €</td>
                    <td class="p-3 border border-gray-300 text-right">20%</td>
                    <td class="p-3 border border-gray-300 text-right">{{ $product->pivot->quantity }}</td>
                    <td class="p-3 border border-gray-300 text-right font-medium">
                        {{ number_format(($product->pivot->price / 1.2) * $product->pivot->quantity, 2) }} €
                    </td>
                </tr>
                @endforeach
                
                <!-- Delivery Fee -->
                @if($invoice->order->delivery_fee > 0)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="p-3 border border-gray-300">Frais de livraison</td>
                    <td class="p-3 border border-gray-300 text-right">{{ number_format($invoice->order->delivery_fee / 1.2, 2) }} €</td>
                    <td class="p-3 border border-gray-300 text-right">20%</td>
                    <td class="p-3 border border-gray-300 text-right">1</td>
                    <td class="p-3 border border-gray-300 text-right font-medium">
                        {{ number_format($invoice->order->delivery_fee / 1.2, 2) }} €
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Totals -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Payment Instructions -->
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
            <h3 class="text-lg font-semibold text-blue-800 border-b pb-2 mb-3">INSTRUCTIONS DE PAIEMENT</h3>
            <div class="space-y-3">
                @if(!$invoice->payment_date)
                    <p class="text-sm">Veuillez régler cette facture avant le <strong>{{ \Carbon\Carbon::parse($invoice->emission_date)->addDays(30)->format('d/m/Y') }}</strong></p>
                @endif
                <p class="font-medium">Modes de paiement acceptés:</p>
                <ul class="list-disc pl-5 text-sm space-y-1">
                    <li>Virement bancaire (coordonnées ci-dessous)</li>
                    <li>Carte bancaire (lien de paiement sécurisé)</li>
                    <li>Chèque (à l'ordre de {{ config('app.name') }})</li>
                </ul>
                <div class="mt-3 p-3 bg-white rounded border border-blue-100">
                    <p class="font-medium text-blue-800 text-sm">COORDONNÉES BANCAIRES</p>
                    <p class="text-sm">IBAN: FR76 3000 4000 0300 1234 5678 900</p>
                    <p class="text-sm">BIC: BNPAFRPPXXX</p>
                    <p class="text-sm">Banque: BNP Paribas</p>
                </div>
                @if(!$invoice->payment_date)
                    <p class="text-xs text-red-600">Conformément à l'article L. 441-6 du code de commerce, une pénalité de 3 fois le taux d'intérêt légal sera appliquée en cas de retard de paiement.</p>
                @endif
            </div>
        </div>
        
        <!-- Summary -->
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-3">RÉCAPITULATIF</h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span>Total HT:</span>
                    <span class="font-medium">{{ number_format($invoice->total_amount / 1.2, 2) }} €</span>
                </div>
                <div class="flex justify-between">
                    <span>TVA (20%):</span>
                    <span class="font-medium">{{ number_format($invoice->total_amount - ($invoice->total_amount / 1.2), 2) }} €</span>
                </div>
                @if($invoice->order->delivery_fee > 0)
                <div class="flex justify-between">
                    <span>Frais de livraison:</span>
                    <span class="font-medium">{{ number_format($invoice->order->delivery_fee, 2) }} €</span>
                </div>
                @endif
                <div class="flex justify-between pt-2 border-t border-gray-300 mt-2">
                    <span class="font-semibold">Total TTC:</span>
                    <span class="font-bold text-lg text-blue-600">{{ number_format($invoice->total_amount, 2) }} €</span>
                </div>
                @if(!$invoice->payment_date)
                    <div class="pt-2 mt-3 text-sm">
                        <p class="font-medium">À payer avant le: <span class="text-red-600">{{ \Carbon\Carbon::parse($invoice->emission_date)->addDays(30)->format('d/m/Y') }}</span></p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-12 pt-6 border-t border-gray-200 text-xs text-gray-500">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="font-medium text-gray-700 mb-1">CONDITIONS DE PAIEMENT</p>
                <p>Paiement à réception de facture, net à 30 jours fin de mois. En cas de retard, pénalités de retard conformément à la loi.</p>
            </div>
            <div>
                <p class="font-medium text-gray-700 mb-1">MENTIONS LÉGALES</p>
                <p>En vertu de l'article L. 441-6 du Code de commerce, les pénalités de retard sont fixées à trois fois le taux d'intérêt légal.</p>
            </div>
        </div>
        <div class="mt-4 text-center">
            <p>{{ config('app.name') }} - {{ config('invoices.legal.siret') }} - TVA Intracom: {{ config('invoices.legal.vat') }}</p>
            <p class="mt-1">Merci pour votre confiance !</p>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4 print:hidden">
        <button onclick="window.print()" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition-colors shadow-md flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Imprimer la Facture
        </button>
        <a href="{{ route('invoices.index') }}" class="px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-500 transition-colors shadow-md flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour aux Factures
        </a>
        @if(!$invoice->payment_date)
        <a href="#" class="px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-500 transition-colors shadow-md flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </svg>
            Payer en Ligne
        </a>
        @endif
    </div>
</div>

<style>
    @media print {
        body, html {
            background: white !important;
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 0 !important;
            box-shadow: none !important;
            max-width: 100% !important;
        }
        .no-print {
            display: none !important;
        }
        .break-after {
            page-break-after: always;
        }
        .break-before {
            page-break-before: always;
        }
        .break-inside {
            page-break-inside: avoid;
        }
        @page {
            margin: 1cm;
            size: A4;
        }
    }
    
    /* Watermark for unpaid invoices */
    @media print {
        body:has(.unpaid)::before {
            content: "NON PAYÉE";
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 5rem;
            color: rgba(239, 68, 68, 0.2);
            font-weight: bold;
            z-index: 1000;
            pointer-events: none;
        }
    }
</style>

<script>
    // Add unpaid class to body if invoice is not paid
    document.addEventListener('DOMContentLoaded', function() {
        @if(!$invoice->payment_date)
            document.body.classList.add('unpaid');
        @endif
    });
</script>
@endsection