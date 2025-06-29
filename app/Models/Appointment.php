<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'id', 
        'user_id', // Ajoutez cette ligne pour stocker l'utilisateur qui a créé le rendez-vous
        'date_time', 
        'location', 
        'status',
    ];

    protected $attributes = [
        'status' => 'Planned', // Valeur par défaut
    ];
    
    protected $casts = [
        'date_time' => 'datetime',
    ];

    // Relation avec le client
    public function client()
    {
        return $this->belongsTo(Client::class, 'id', 'id');
    }

    // Relation avec l'utilisateur (auteur du rendez-vous)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function updatePastAppointments()
    {
        $now = Carbon::now();
        return self::where('date_time', '<', $now)
                ->where('status', 'Planned')
                ->update(['status' => 'Realized']);
    }
    ///////////////////////////statut change/////////

    /**
     * Scope pour les rendez-vous à venir
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date_time', '>', now())
                    ->where('status', 'Planned');
    }

    /**
     * Scope pour les rendez-vous passés
     */
    public function scopePast($query)
    {
        return $query->where('date_time', '<', now())
                    ->where('status', 'Planned');
    }
}
