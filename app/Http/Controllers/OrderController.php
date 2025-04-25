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
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id'  => 'required|exists:products,id',
            'quantity'    => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'status' => 'required|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek stok produk
        if ($request->quantity > $product->stock) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['quantity' => 'Jumlah pesanan melebihi stok produk yang tersedia.']);
        }

        $totalPrice = $product->price * $request->quantity;

        Order::create([
            'customer_id'     => $request->customer_id,
            'product_id'      => $request->product_id,
            'quantity'        => $request->quantity,
            'total_price'     => $totalPrice,
            'payment_method'  => $request->payment_method,
            'status'          => $request->status,
        ]);

        // Kurangi stok
        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan.');
    }
}
