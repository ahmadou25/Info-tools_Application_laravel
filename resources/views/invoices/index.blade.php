@extends('invoices.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Liste des Factures</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Gestion des factures clients</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                <a href="{{ route('dashboard') }}" class="btn-dashboard flex items-center justify-center gap-2 px-4 py-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Dashboard
                </a>
                @can('create', App\Models\Invoice::class)
                <a href="{{ route('invoices.create') }}" class="btn-primary flex items-center justify-center gap-2 px-4 py-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    Nouvelle Facture
                </a>
                @endcan
            </div>
        </div>
        <!-- Search Form -->
        <form action="{{ route('invoices.index') }}" method="GET" class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 w-full max-w-2xl mx-auto mb-6">
            <div class="flex flex-col sm:flex-row gap-3 items-center w-full">
                <div class="w-full relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" 
                        class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:border-blue-400 text-base" 
                        placeholder="Rechercher par numéro de facture ou client..." 
                        value="{{ request()->get('search') }}">
                </div>
                <button type="submit" class="btn-primary px-4 py-2 text-base whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Rechercher
                </button>
            </div>
        </form>
        @if(session('success'))
            <div class="alert-success py-2 px-3 text-sm mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Invoices Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commande</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Émission</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paiement</th>
                            <th scope="col" class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($invoices as $invoice)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $invoice->invoice_id }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $invoice->order->order_id }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ $invoice->order->client ? $invoice->order->client->first_name . ' ' . $invoice->order->client->last_name : 'cher Client' }},
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ number_format($invoice->total_amount, 2) }} €</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($invoice->emission_date)->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ $invoice->payment_date ? \Carbon\Carbon::parse($invoice->payment_date)->format('d/m/Y') : 'Non payé' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('invoices.show', $invoice->invoice_id) }}" class="btn-view px-3 py-1.5 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                        Détails
                                    </a>
                                    
                                    @can('update', $invoice)
                                    <a href="{{ route('invoices.edit', $invoice->invoice_id) }}" class="btn-edit px-3 py-1.5 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Modifier
                                    </a>
                                    @endcan
                                    
                                    @can('delete', $invoice)
                                    <form action="{{ route('invoices.destroy', $invoice->invoice_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete px-3 py-1.5 text-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            Supprimer
                                        </button>
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

        <!-- Pagination -->
        <div class="mt-4">
           
        </div>
    </div>

    <style>
        .btn-dashboard {
            background-color: #4b5563;
            color: white;
            border-radius: 0.25rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-dashboard:hover {
            background-color: #374151;
            transform: translateY(-1px);
        }
        
        .btn-primary {
            background-color: #3b82f6;
            color: white;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-primary:hover {
            background-color: #2563eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .alert-success {
            background-color: #10b981;
            color: white;
            border-radius: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-view, .btn-edit, .btn-delete {
            display: inline-flex;
            align-items: center;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        
        .btn-view {
            background-color: #3b82f6;
            color: white;
            border: 1px solid #2563eb;
        }
        
        .btn-view:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }
        
        .btn-edit {
            background-color: #10b981;
            color: white;
            border: 1px solid #059669;
        }
        
        .btn-edit:hover {
            background-color: #059669;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
        }
        
        .btn-delete {
            background-color: #ef4444;
            color: white;
            border: 1px solid #dc2626;
        }
        
        .btn-delete:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
        
        .page-item {
            margin: 0 0.125rem;
        }
        
        .page-link {
            padding: 0.25rem 0.5rem;
            border-radius: 0.125rem;
            border: 1px solid #d1d5db;
            color: #4b5563;
            font-size: 0.75rem;
            transition: all 0.2s;
        }
        
        .page-link:hover {
            background-color: #f3f4f6;
        }
        
        .page-item.active .page-link {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        
        .page-item.disabled .page-link {
            color: #9ca3af;
            pointer-events: none;
        }
    </style>
@endsection