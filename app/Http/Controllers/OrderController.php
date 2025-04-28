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
        // Validation des données
        $request->validate([
            'id' => 'required|exists:clients,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,product_id',
            'products.*.quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);
    
        // Crée la commande
        $order = Order::create([
            'id' => $request->id,
            'date' => $request->date,
            'amount' => 0, // Le montant total sera calculé ci-dessous
        ]);
    
        $totalAmount = 0;
    
        // Ajoute les produits à la commande
        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['product_id']);
            $quantity = $productData['quantity'];
            $price = $product->price;
    
            // Ajoute le produit à la commande via la table pivot
            $order->products()->attach($product->product_id, [
                'quantity' => $quantity,
                'price' => $price,
            ]);
    
            // Calcule le montant total
            $totalAmount += $price * $quantity;
        }
    
        // Met à jour le montant total de la commande
        $order->update(['amount' => $totalAmount]);
    
        // Crée une facture associée à cette commande
        Invoice::create([
            'order_id' => $order->order_id,
            'total_amount' => $totalAmount,
            'emission_date' => $request->date,
            'payment_date' => $request->payment_date ?? $request->date,
        ]);
    
        return redirect()->route('orders.index')->with('success', 'Commande créée avec succès.');
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
        // Trouver la commande et vérifier les permissions
        $order = Order::findOrFail($id);
        $this->authorize('update', $order);
    
        // Valider les données de la requête
        $request->validate([
            'id' => 'required|exists:clients,id',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,product_id',
            'products.*.quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);
    
        // Récupérer les données des produits envoyés par la requête
        $updatedProductData = collect($request->products);
        $updatedProductIds = $updatedProductData->pluck('product_id')->toArray();
    
        // Récupérer les produits existants dans la commande
        $currentProductIds = $order->products->pluck('product_id')->toArray();
    
        // Synchroniser les produits et recalculer le montant total
        $totalAmount = 0;
    
        // Parcourir les produits envoyés pour les ajouter ou mettre à jour
        $syncData = [];
        foreach ($updatedProductData as $productData) {
            $product = Product::findOrFail($productData['product_id']);
            $quantity = $productData['quantity'];
            $price = $product->price;
    
            // Ajouter les informations pour la table pivot
            $syncData[$product->product_id] = [
                'quantity' => $quantity,
                'price' => $price,
            ];
    
            // Recalculer le montant total
            $totalAmount += $quantity * $price;
        }
    
        // Synchroniser les données avec la table pivot (ajoute, met à jour ou supprime)
        $order->products()->sync($syncData);
    
        // Mettre à jour les informations de la commande
        $order->update([
            'id' => $request->id,
            'date' => $request->date,
            'amount' => $totalAmount,
        ]);
    
        // Redirection avec un message de succès
        return redirect()->route('orders.index')->with('success', 'Commande mise à jour avec succès.');
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
