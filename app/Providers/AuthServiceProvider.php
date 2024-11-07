<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Order;
use App\Policies\ProductPolicy;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Les mappages de politiques pour l'application.
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    /**
     * Enregistrez les services d'authentification.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
