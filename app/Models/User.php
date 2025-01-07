<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasTeams;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;
    use HasTeams; // Assurez-vous d'ajouter ceci
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'role',
        'password',
        'ad_id',
        'current_team_id', // Ajouter si ce champ est modifiable via un formulaire
        'profile_photo_path', // Ajouter si tu permets l'ajout de photos de profil
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ad_id' => 'integer', // Cast à 'integer' si tu souhaites un typage précis
        'current_team_id' => 'integer', // Ajouter si ce champ est présent
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Vérifie si l'utilisateur a un rôle de Manager.
     *
     * @return bool
     */
    public function isManager(): bool
    {
        return $this->role === 'Manager';
    }

    /**
     * Vérifie si l'utilisateur a un rôle de Salesperson.
     *
     * @return bool
     */
    public function isSalesperson(): bool
    {
        return $this->role === 'Salesperson';
    }

    /**
     * Obtient l'équipe actuelle de l'utilisateur.
     */
    // public function currentTeam()
    // {
    //     return $this->belongsTo(Team::class, 'current_team_id'); // Assurez-vous que 'current_team_id' est la clé étrangère dans la table users
    // }

    public function ownedTeams()
    {
        return $this->hasMany(Team::class, 'user_id'); // Assurez-vous que 'user_id' est la colonne de clé étrangère dans la table teams
    }

    public function hasRole(string $role)
    {
        // Vérifiez si l'utilisateur a le rôle spécifié
        return $this->role === $role; // Adaptez cela selon votre logique de gestion des rôles
    }
    
}
