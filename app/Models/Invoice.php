<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // Spécifiez le nom de la table
    protected $table = 'invoices';

    // Définir la clé primaire si différente de "id"
    protected $primaryKey = 'invoice_id';

    // Indiquer si la clé primaire est incrémentée automatiquement
    public $incrementing = true;

    // Spécifier le type de la clé primaire si nécessaire
    protected $keyType = 'int';

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
