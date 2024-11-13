<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si l'utilisateur peut voir la liste des clients.
     */
    public function viewAny(User $user)
    {
        // Autoriser uniquement les utilisateurs ayant les rôles 'Manager' ou 'Salesperson'
        return $user->hasRole('Manager') || $user->hasRole('Salesperson');
    }

    /**
     * Détermine si l'utilisateur peut voir un client spécifique.
     */
    public function view(User $user, Client $client)
    {
        // Autoriser uniquement les 'Manager' et 'Salesperson'
        return $user->hasRole('Manager') || $user->hasRole('Salesperson');
    }

    /**
     * Détermine si l'utilisateur peut créer un nouveau client.
     */
    public function create(User $user)
    {
        // Autoriser uniquement les utilisateurs ayant le rôle 'Manager'
        return $user->hasRole('Manager') || $user->hasRole('Salesperson');
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour un client spécifique.
     */
    public function update(User $user, Client $client)
    {
        // Autoriser uniquement les 'Manager'
        return $user->hasRole('Manager');
    }

    /**
     * Détermine si l'utilisateur peut supprimer un client spécifique.
     */
    public function delete(User $user, Client $client)
    {
        // Autoriser uniquement les 'Manager'
        return $user->hasRole('Manager');
    }
}
