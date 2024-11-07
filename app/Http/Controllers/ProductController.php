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
        $products = Product::all();
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
        $this->authorize('create', Product::class);
   
        // Validate the incoming request data
        $this->validateProduct($request);

        // Create a new product instance
        Product::create($request->all());

        // Redirect to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Product added successfully');
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
            'price' => 'required|numeric|min:0',  // Ensure price is a positive number
            'stock' => 'required|integer|min:0',  // Ensure stock is a non-negative integer
        ]);
    }
}
