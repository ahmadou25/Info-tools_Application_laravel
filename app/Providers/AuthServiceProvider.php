<?php

namespace App\Providers;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Order;
use App\Models\Client;
use App\Policies\ProductPolicy;
use App\Policies\OrderPolicy;
use App\Policies\InvoicePolicy;
use App\Policies\ClientPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Les mappages de politiques pour l'application.
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        Client::class => ClientPolicy::class,
        Invoice::class => InvoicePolicy::class,
    ];

    /**
     * Enregistrez les services d'authentification.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
