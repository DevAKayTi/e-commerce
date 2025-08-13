<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Support\Str;

class AdminProductVariantController extends Controller
{
    // GET /admin/products/{product_id}/variants
    public function index($product_id)
    {
        $product = Product::findOrFail($product_id);
        $variants = $product->variants()->get();
        return response()->json($variants);
    }

    // POST /admin/products/{product_id}/variants (create)
    public function store(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:product_variants,sku',
            'price_cents' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $variant = $product->variants()->create([
            'name' => $request->name,
            'sku' => $request->sku,
            'price_cents' => $request->price_cents,
            'stock' => $request->stock,
            'is_active' => $request->has('is_active') ? $request->is_active : true
        ]);

        return response()->json(['message' => 'Product variant created', 'variant' => $variant]);
    }

    // GET /admin/products/{product_id}/variants/{id}
    public function show($product_id, $id)
    {
        $product = Product::findOrFail($product_id);
        $variant = $product->variants()->where('id', $id)->firstOrFail();
        return response()->json($variant);
    }

    // POST /admin/products/{product_id}/variants/{id} (update)
    public function update(Request $request, $product_id, $id)
    {
        $product = Product::findOrFail($product_id);
        $variant = $product->variants()->where('id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:product_variants,sku,' . $variant->id,
            'price_cents' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $variant->update([
            'name' => $request->name,
            'sku' => $request->sku,
            'price_cents' => $request->price_cents,
            'stock' => $request->stock,
            'is_active' => $request->has('is_active') ? $request->is_active : $variant->is_active
        ]);

        return response()->json(['message' => 'Product variant updated', 'variant' => $variant]);
    }

    // DELETE /admin/products/{product_id}/variants/{id}
    public function destroy($product_id, $id)
    {
        $product = Product::findOrFail($product_id);
        $variant = $product->variants()->where('id', $id)->firstOrFail();
        $variant->delete();

        return response()->json(['message' => 'Product variant deleted']);
    }
}
