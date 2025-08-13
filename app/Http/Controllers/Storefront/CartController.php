<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;

class CartController extends Controller
{
    // GET /store/cart
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        return response()->json($cart);
    }

    // POST /store/cart/add
    public function add(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        $variantId = $request->variant_id;

        if (isset($cart[$variantId])) {
            $cart[$variantId]['quantity'] += $request->quantity;
        } else {
            $variant = ProductVariant::findOrFail($variantId);
            $cart[$variantId] = [
                'variant_id' => $variant->id,
                'product_name' => $variant->product->name,
                'variant_name' => $variant->name,
                'price_cents' => $variant->price_cents,
                'quantity' => $request->quantity
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['message' => 'Item added to cart', 'cart' => $cart]);
    }

    // POST /store/cart/remove
    public function remove(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id'
        ]);

        $cart = session()->get('cart', []);
        unset($cart[$request->variant_id]);
        session()->put('cart', $cart);

        return response()->json(['message' => 'Item removed from cart', 'cart' => $cart]);
    }

    // POST /store/cart/update
    public function update(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        if (isset($cart[$request->variant_id])) {
            $cart[$request->variant_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return response()->json(['message' => 'Cart updated', 'cart' => $cart]);
    }
}
