<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Affiche la liste des commandes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Vérifie si l'utilisateur a le droit de voir les commandes
        $this->authorize('viewAny', Order::class);

        // Récupère les clients qui ont des commandes
        $clients = Client::whereHas('orders')->get();

        if ($request->has('client_id') && $request->get('client_id') != '') {
            $orders = Order::where('client_id', $request->get('client_id'))->get();
        } else {
            $orders = Order::all();
        }

        // Renvoie la vue avec les commandes et les clients
        return view('orders.index', compact('orders', 'clients'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle commande.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Vérifie si l'utilisateur a le droit de créer une commande
        $this->authorize('create', Order::class);

        // Récupère les clients et les produits
        $clients = Client::all();
        $products = Product::all();

        return view('orders.create', compact('clients', 'products'));
    }

    /**
     * Stocke une nouvelle commande en base.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Vérifie si l'utilisateur a le droit de créer une commande
        $this->authorize('create', Order::class);
        
        // Validation des données
        $request->validate([
            'id' => 'required|exists:clients,id', 
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);
        
        // Récupère le produit et calcule le montant total
        $product = Product::findOrFail($request->product_id);
        $amount = $product->price * $request->quantity;
        
        // Crée la commande
        $order = new Order([
            'id' => $request->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'date' => $request->date,
            'amount' => $amount,
        ]);
        
        // Sauvegarde la commande en base
        $order->save();
        
        // Crée la facture associée à cette commande
        $invoice = new Invoice([
            'order_id' => $order->order_id,
            'total_amount' => $amount,
            'emission_date' => $request->date, // Utiliser la même date de la commande comme date d'émission
            'payment_date' => $request->payment_date ?? $request->date, // Utiliser la date de commande comme date de paiement par défaut
        ]);
        
        // Sauvegarde la facture en base
        $invoice->save();
        
        // Redirige avec un message de succès
        return redirect()->route('orders.index')->with('success', 'La commande et la facture ont été créées avec succès.');
    }
    
    

    /**
     * Affiche une commande spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Trouve la commande et autorise son affichage
        $order = Order::findOrFail($id);
        $this->authorize('view', $order);

        // Retourne la vue avec les informations de la commande
        return view('orders.show', compact('order'));
    }

    /**
     * Affiche le formulaire de modification d'une commande spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Trouve la commande et autorise la modification
        $order = Order::findOrFail($id);
        $this->authorize('update', $order);

        // Récupère les clients et les produits pour l'édition
        $clients = Client::all();
        $products = Product::all();

        return view('orders.edit', compact('order', 'clients', 'products'));
    }

    /**
     * Met à jour une commande spécifique en base.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Trouve la commande et autorise la mise à jour
        $order = Order::findOrFail($id);
        $this->authorize('update', $order);

        // Validation des données
        $request->validate([
            'id' => 'required|exists:clients,id',
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        // Récupère le produit pour calculer le montant
        $product = Product::findOrFail($request->product_id);
        $amount = $product->price * $request->quantity;

        // Met à jour la commande
        $order->update([
            'id' => $request->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'date' => $request->date,
            'amount' => $amount,
        ]);

        // Redirige avec un message de succès
        return redirect()->route('orders.index')->with('success', 'Commande mise à jour avec succès');
    }

    /**
     * Supprime une commande spécifique de la base.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Trouve la commande
        $order = Order::findOrFail($id);
    
        // Vérifie si la commande est utilisée dans la table des factures
        if ($order->invoices()->count() > 0) {
            return redirect()->route('orders.index')->with('error', 'Impossible de supprimer cette commande, elle est liée à une facture.');
        }
    
        // Supprime la commande
        $order->delete();
    
        // Redirige avec un message de succès
        return redirect()->route('orders.index')->with('success', 'Commande supprimée avec succès');
    }
    
}
