<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Détermine si l'utilisateur peut visualiser toutes les commandes.
     */
    public function viewAny(User $user)
    {
        // Autorise les Managers et Salesperson à visualiser les commandes
        return $user->hasRole('Manager') || $user->hasRole('Salesperson');
    }

    /**
     * Détermine si l'utilisateur peut visualiser une commande spécifique.
     */
    public function view(User $user, Order $order)
    {
        // Autorise les Managers et Salesperson à visualiser une commande
        return $user->hasRole('Manager') || $user->hasRole('Salesperson');
    }

    /**
     * Détermine si l'utilisateur peut créer une commande.
     */
    public function create(User $user)
    {
        // Autorise uniquement les Managers à créer des commandes
        return $user->hasRole('Manager') || $user->hasRole('Salesperson');
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour une commande spécifique.
     */
    public function update(User $user, Order $order)
    {
        // Autorise uniquement les Managers à mettre à jour une commande
        return $user->hasRole('Manager');
    }

    /**
     * Détermine si l'utilisateur peut supprimer une commande spécifique.
     */
    public function delete(User $user, Order $order)
    {
        // Autorise uniquement les Managers à supprimer une commande
        return $user->hasRole('Manager');
    }
}
