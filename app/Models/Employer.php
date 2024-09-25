<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $table = 'employers'; // Nom de la table
    protected $primaryKey = 'employer_id'; // Clé primaire

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
        'role',
        'ad_id', // Référence à une annonce, si applicable
    ];

    // Méthode pour vérifier le rôle de l'employé
    public function isManager(): bool
    {
        return $this->role === 'Manager';
    }

    public function isSalesperson(): bool
    {
        return $this->role === 'Salesperson';
    }

    // Fonction pour définir un mot de passe sécurisé
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    // Relation avec les rendez-vous
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'salesperson_id', 'employer_id');
    }

    // Relation avec les commandes
    public function orders()
    {
        return $this->hasMany(Order::class, 'salesperson_id', 'employer_id');
    }
}
