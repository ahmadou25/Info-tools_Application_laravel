<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments'; // Nom de la table
    protected $primaryKey = 'appointment_id'; // Clé primaire

    protected $fillable = [
        'client_id',
        'salesperson_id',
        'date_time',
        'location',
        'status',
    ];

    // Relation avec le client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    // Relation avec l'employé (salesperson)
    public function salesperson()
    {
        return $this->belongsTo(Employer::class, 'salesperson_id', 'employer_id');
    }

    // Méthode pour marquer le rendez-vous comme réalisé
    public function markAsRealized()
    {
        $this->update(['status' => 'Realized']);
    }

    // Méthode pour marquer le rendez-vous comme annulé
    public function markAsCanceled()
    {
        $this->update(['status' => 'Canceled']);
    }

    // Méthode pour vérifier si le rendez-vous est réalisé
    public function isRealized(): bool
    {
        return $this->status === 'Realized';
    }

    // Méthode pour vérifier si le rendez-vous est annulé
    public function isCanceled(): bool
    {
        return $this->status === 'Canceled';
    }
}
