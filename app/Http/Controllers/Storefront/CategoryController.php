<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    // GET /store/categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // GET /store/categories/{slug}
    public function show($slug)
    {
        $category = Category::with('products.variants')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json($category);
    }
}
