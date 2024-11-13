<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vérifie si l'utilisateur peut voir la liste des factures
        $this->authorize('viewAny', Invoice::class);

        // Récupère toutes les factures et les renvoie à la vue
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Vérifie si l'utilisateur peut créer une facture
        $this->authorize('create', Invoice::class);

        // Affiche le formulaire de création de facture avec les commandes disponibles
        $orders = Order::all(); // Ou utilisez une méthode pour récupérer uniquement les commandes non facturées
        return view('invoices.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Vérifie si l'utilisateur peut créer une facture
        $this->authorize('create', Invoice::class);

        // Valide les données de la requête
        $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'emission_date' => 'required|date',
            'payment_date' => 'nullable|date|after_or_equal:emission_date',
        ]);

        // Récupère la commande pour calculer le montant total
        $order = Order::findOrFail($request->order_id);
        $totalAmount = $order->amount; // Utilisez le montant de la commande

        // Crée une nouvelle facture
        $invoice = new Invoice([
            'order_id' => $request->order_id,
            'total_amount' => $totalAmount,
            'emission_date' => $request->emission_date,
            'payment_date' => $request->payment_date,
        ]);

        // Sauvegarde la facture dans la base de données
        $invoice->save();

        // Redirige vers l'index avec un message de succès
        return redirect()->route('invoices.index')->with('success', 'Facture créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        // Vérifie si l'utilisateur peut voir cette facture
        $this->authorize('view', $invoice);

        // Affiche les détails de la facture spécifiée
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        // Vérifie si l'utilisateur peut modifier cette facture
        $this->authorize('update', $invoice);

        // Affiche le formulaire de modification de la facture
        $orders = Order::all();
        return view('invoices.edit', compact('invoice', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        // Vérifie si l'utilisateur peut modifier cette facture
        $this->authorize('update', $invoice);

        // Valide les données de la requête
        $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'emission_date' => 'required|date',
            'payment_date' => 'nullable|date|after_or_equal:emission_date',
        ]);

        // Met à jour la facture avec les nouvelles données
        $invoice->order_id = $request->order_id;
        $invoice->emission_date = $request->emission_date;
        $invoice->payment_date = $request->payment_date;

        // Enregistre les modifications dans la base de données
        $invoice->save();

        // Redirige vers l'index avec un message de succès
        return redirect()->route('invoices.index')->with('success', 'Facture mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        // Vérifie si l'utilisateur peut supprimer cette facture
        $this->authorize('delete', $invoice);

        // Supprime la facture spécifiée
        $invoice->delete();

        // Redirige vers l'index avec un message de succès
        return redirect()->route('invoices.index')->with('success', 'Facture supprimée avec succès.');
    }
}
