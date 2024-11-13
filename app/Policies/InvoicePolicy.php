<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    /**
     * Détermine si l'utilisateur peut visualiser toutes les factures.
     */
    public function viewAny(User $user)
    {
        // Autorise les Managers et Salesperson à visualiser les factures
        return $user->hasRole('Manager') || $user->hasRole('Salesperson');
    }

    /**
     * Détermine si l'utilisateur peut visualiser une facture spécifique.
     */
    public function view(User $user, Invoice $invoice)
    {
        // Autorise les Managers et Salesperson à visualiser une facture
        return $user->hasRole('Manager') || $user->hasRole('Salesperson');
    }

    /**
     * Détermine si l'utilisateur peut créer une facture.
     */
    public function create(User $user)
    {
        // Autorise uniquement les Managers et Salesperson à créer une facture
        return $user->hasRole('Manager');
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour une facture spécifique.
     */
    public function update(User $user, Invoice $invoice)
    {
        // Autorise uniquement les Managers à mettre à jour une facture
        return $user->hasRole('Manager');
    }

    /**
     * Détermine si l'utilisateur peut supprimer une facture spécifique.
     */
    public function delete(User $user, Invoice $invoice)
    {
        // Autorise uniquement les Managers à supprimer une facture
        return $user->hasRole('Manager');
    }
}
