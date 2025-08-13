<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    // POST /store/checkout
    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'address' => 'required|string|max:500'
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'address' => $request->address,
            'status' => 'pending',
            'total_cents' => array_sum(array_map(fn($item) => $item['price_cents'] * $item['quantity'], $cart))
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item['variant_id'],
                'quantity' => $item['quantity'],
                'price_cents' => $item['price_cents']
            ]);
        }

        session()->forget('cart');

        return response()->json(['message' => 'Order placed successfully', 'order' => $order]);
    }
}
