<?php

namespace App\Providers;

use App\Repository\cart\cartRepositoryImpl;
use Illuminate\Support\ServiceProvider;
use App\Repository\cart\CartRepository;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CartRepository::class, function () {
            return new cartRepositoryImpl();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
