<?php

namespace App\Repository\cart;

use App\Repository\Cart\cartRepository;
use App\Models\cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\cookie;

/**
 * Implementation of cartRepository
 */
class cartRepositoryImpl implements cartRepository
{
    /**
     * cartRepositoryImpl constructor.
     */
    protected $items;
    public function __construct()
    {
        $this->items = collect();
    }

    /**
     * Generic magic handler to allow flexible calls in case the interface
     * is extended without breaking this concrete implementation.
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        // Implement or route dynamic calls as needed.
        return null;
    }
    public function get(): Collection
    {
        if (!$this->items->count()) {
            $this->items = cart::with('product')->get();
        }
        return $this->items;
    }
    public function add(Product $product, int $quantity = 1)
    {
        $item = cart::where('product_id', '=', $product->id)
            ->first();

        if (!$item) {
            return cart::create([
                'cookie_id' => cart::getCookieId(),
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,

            ]);

        }

        return $item->increment('quantity', $quantity);

    }
    public function update($id, int $quantity)
    {
        $cartItem = cart::where('id', '=', $id)
            ->first();
        if ($cartItem) {
            $cartItem->update(['quantity' => $quantity]);
        }
        return $cartItem;
    }
    public function delete($id)
    {
        cart::where('id', '=', $id)->delete();
    }
    public function empty()
    {
        cart::query()->delete();

    }
    public function total()
    {
        /* return cart::join('products', 'carts.product_id', '=', 'products.id')
             ->selectRaw('SUM(products.price * carts.quantity) as total')
             ->value('total');*/
        return $this->get()->sum(
            function ($item) {

                return $item->quantity * $item->product->price;
            }
        );


    }


}
