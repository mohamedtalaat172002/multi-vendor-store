<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category', 'store')
            ->active($request->status)
            ->search($request->only('search'))
            ->category($request->category)
            ->paginate(20);

        $categories = Category::all();
        return view('dashboard.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $stores = Store::all();
        return view('dashboard.product.create', compact('categories', 'stores'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $stores = Store::all();
        return view('dashboard.product.edit', compact('product', 'categories', 'stores'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image)
                Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image)
            Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('dashboard.products.index')->with('success', 'Product deleted successfully.');
    }
}