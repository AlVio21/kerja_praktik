<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
    
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
    
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|in:cash,credit',
            'status' => 'required|in:pending,processed,shipped,completed',
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.orders.edit', compact('order', 'customers', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|in:cash,credit',
            'status' => 'required|in:pending,processed,shipped,completed',
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}
