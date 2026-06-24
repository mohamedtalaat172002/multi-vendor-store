<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend(
            'filter',
            function ($attribute, $value, $parameters, $validator) {
                return !str_contains(strtolower($value), 'admin');
            },
            'The :attribute cannot contain the word "admin".'
        );

        Paginator::useBootstrap();
    }

}
