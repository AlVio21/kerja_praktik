<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with(['customer', 'product'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|in:cash,credit',
            'status' => 'in:pending,processed,shipped,completed',
        ]);

        return Order::create($data);
    }

    public function show(Order $order)
    {
        return $order->load(['customer', 'product']);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'customer_id' => 'sometimes|exists:customers,id',
            'product_id' => 'sometimes|exists:products,id',
            'quantity' => 'sometimes|integer|min:1',
            'total_price' => 'sometimes|numeric',
            'payment_method' => 'sometimes|in:cash,credit',
            'status' => 'in:pending,processed,shipped,completed',
        ]);

        $order->update($data);
        return $order->load(['customer', 'product']);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->noContent();
    }
}
