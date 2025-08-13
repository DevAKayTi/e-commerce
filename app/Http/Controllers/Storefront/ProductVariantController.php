<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductVariantController extends Controller
{
    // GET /store/products/{slug}/variants
    public function index($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $variants = $product->variants()->get();
        return response()->json($variants);
    }

    // GET /store/products/{slug}/variants/{id}
    public function show($slug, $id)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $variant = $product->variants()->where('id', $id)->firstOrFail();
        return response()->json($variant);
    }
}
