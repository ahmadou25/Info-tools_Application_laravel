<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // Spécifiez le nom de la table si différent du pluriel du modèle
    protected $table = 'invoices';

    // Spécifiez les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'order_id',
        'total_amount',
        'emission_date',
        'payment_date',
    ];

    /**
     * Définir la relation avec le modèle Order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
