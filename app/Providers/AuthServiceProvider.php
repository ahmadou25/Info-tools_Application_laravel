<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Les mappages de politique pour l'application.
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

    /**
     * Enregistrez les services d'authentification.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
