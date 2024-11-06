<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function viewAny(User $user)
    {
        // Autorise l'accès pour les Managers et Salesperson
        return $user->hasRole('Manager') || $user->hasRole('Salesperson');
    }

    public function view(User $user, Product $product)
    {
        return $user->hasRole('Manager') || $user->hasRole('Salesperson');
    }

    public function create(User $user)
    {
        return $user->hasRole('Manager');
    }

    public function update(User $user, Product $product)
    {
        return $user->hasRole('Manager');
    }

    public function delete(User $user, Product $product)
    {
        return $user->hasRole('Manager');
    }
}
  