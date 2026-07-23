<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Repository\cart\CartRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    protected $cart;
    public function __construct(CartRepository $cart)
    {

        $this->cart = $cart;
    }

    public function index()
    {
        $items = $this->cart->get();
        return view('Front.cart.index', [
            'cart' => $items,
        ]);

    }



    public function store(Request $request, CartRepository $cart)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $cart->add($product, $validated['quantity']);
        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart  ');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, CartRepository $cart)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update($id, $validated['quantity']);
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, CartRepository $cart)
    {
        $cart->delete($id);

        return response()->json(['success' => true]);
    }
}
