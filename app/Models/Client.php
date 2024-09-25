<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients'; // Nom de la table
    protected $primaryKey = 'client_id'; // Clé primaire

    // Les attributs que vous pouvez remplir
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'phone',
        'address',
        'type',
        'prospect', // Ajout de la colonne 'prospect'
    ];

    // Relation avec les commandes
    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id', 'client_id');
    }

    // Relation avec les rendez-vous
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'client_id', 'client_id');
    }

    // Fonction pour définir un client comme prospect
    public function markAsProspect()
    {
        $this->prospect = true;
        $this->save();
    }

    // Fonction pour définir un client comme non prospect
    public function markAsNotProspect()
    {
        $this->prospect = false;
        $this->save();
    }

    // Fonction pour vérifier si un client est un prospect
    public function isProspect(): bool
    {
        return $this->prospect;
    }
}
