<?php

namespace App\Repository\cart;

use Illuminate\Support\Collection;
use App\Models\product;
//use Illuminate\Database\Eloquent\Collection;
interface CartRepository
{
    // Define cart repository interface methods here
    public function get(): Collection;
    public function add(Product $product, int $quantity = 1);
    public function update($id, int $quantity);
    public function delete($product_id);

    public function empty();
    public function total();
}
