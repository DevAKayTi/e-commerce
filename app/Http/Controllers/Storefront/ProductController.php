<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // GET /store/products
    public function index(Request $request)
    {
        $query = Product::with('category', 'variants')->where('is_active', true);

        // Optional category filter
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Pagination
        $products = $query->paginate(12);

        return response()->json($products);
    }

    // GET /store/products/{slug}
    public function show(Request $request)
    {
        $product = Product::with('variants')->where('slug', $request->slug)->where('is_active', true)->firstOrFail();
        return response()->json($product);
    }
}
