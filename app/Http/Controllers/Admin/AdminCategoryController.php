<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    // GET /admin/categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // POST /admin/categories
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json(['message' => 'Category created', 'category' => $category]);
    }

    // GET /admin/categories/{id}
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    // POST /admin/categories/{id} (update)
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json(['message' => 'Category updated', 'category' => $category]);
    }

    // DELETE /admin/categories/{id}
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}
