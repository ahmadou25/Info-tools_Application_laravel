<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        
        $search = request()->get('search');
        
        $products = Product::when($search, function($query) use ($search) {
            return $query->where('name', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
        })->paginate(10);
    
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'nullable|string',
            'sku' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation image
        ]);
    
        // Si le champ image est présent, on la télécharge
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        // Créer le produit dans la base de données
        Product::create($validatedData);
    
        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès');
    }
    
    
    /**
     * Display the specified product.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $product)
    {
        // Récupérer d'abord l'objet Product
        $product = Product::findOrFail($product);
    
        // Autoriser ensuite l'action 'view' pour l'objet Product récupéré
        $this->authorize('view', $product);
    
        // Si l'utilisateur est autorisé, afficher la vue des détails
        return view('products.show', compact('product'));
    }
    
    /**
     * Show the form for editing the specified product.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        // Validate the incoming request data
        $this->validateProduct($request);

        // Update the product instance
        $product->update($request->all());

        // Redirect to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();  // Delete the product

        // Redirect to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    /**
     * Validate the product data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    private function validateProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:100',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'weight' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048', // Si tu veux gérer l'upload réel
        ]);
    }
}
