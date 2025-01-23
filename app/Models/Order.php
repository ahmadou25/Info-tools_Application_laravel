<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'id',
        'date',
        'amount',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
    

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'order_id', 'order_id');
    }
}