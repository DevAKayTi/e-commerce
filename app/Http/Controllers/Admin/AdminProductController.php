<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    // GET /admin/products
    public function index()
    {
        $products = Product::with('category', 'variants')->get();
        return response()->json($products);
    }

    // POST /admin/products (create)
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string',
            'price_cents' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price_cents' => $request->price_cents,
            'is_active' => $request->has('is_active') ? $request->is_active : true
        ]);

        return response()->json(['message' => 'Product created', 'product' => $product]);
    }

    // GET /admin/products/{id}
    public function show($id)
    {
        $product = Product::with('category', 'variants')->findOrFail($id);
        return response()->json($product);
    }

    // POST /admin/products/{id} (update)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'nullable|string',
            'price_cents' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price_cents' => $request->price_cents,
            'is_active' => $request->has('is_active') ? $request->is_active : $product->is_active
        ]);

        return response()->json(['message' => 'Product updated', 'product' => $product]);
    }

    // DELETE /admin/products/{id}
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}
