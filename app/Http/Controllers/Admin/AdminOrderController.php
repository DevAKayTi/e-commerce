<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class AdminOrderController extends Controller
{
    // GET /admin/orders
    public function index(Request $request)
    {
        $query = Order::with('items.variant.product')->orderBy('created_at', 'desc');

        // Optional filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(20);

        return response()->json($orders);
    }

    // GET /admin/orders/{id}
    public function show($id)
    {
        $order = Order::with('items.variant.product')->findOrFail($id);
        return response()->json($order);
    }

    // POST /admin/orders/{id}/update-status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,refunded'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order status updated', 'order' => $order]);
    }
}
