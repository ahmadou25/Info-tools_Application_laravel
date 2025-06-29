<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Nom de la table
    protected $primaryKey = 'product_id'; // Clé primaire

    protected $fillable = [
        'name',        // Nom du produit
        'description', // Description du produit
        'price',       // Prix du produit
        'stock',       // Stock disponible
        'category',
        'sku',
        'weight',
        'image',
    ];

    // Relation avec les commandes
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    // Méthode pour vérifier la disponibilité du produit
    public function isAvailable($quantity)
    {
        return $this->stock >= $quantity;
    }

    // Méthode pour ajuster le stock après une commande
    public function adjustStock($quantity)
    {
        $this->stock -= $quantity;
        $this->save();
    }
 /// diaw
    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
