<?php

namespace App\Facades;

use App\Repository\cart\CartRepository;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
    public static function getFacadeAccessor()
    {
        return CartRepository::class;
    }
}
