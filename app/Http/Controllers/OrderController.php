<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
    
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
    
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Menampilkan form untuk menambah pesanan.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.create', compact('customers', 'products'));
    }

    /**
     * Menyimpan pesanan baru.
     */
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
    $totalPrice = $product->price * $request->quantity;

    Order::create([
        'customer_id'     => $request->customer_id,
        'product_id'      => $request->product_id,
        'quantity'        => $request->quantity,
        'total_price'     => $totalPrice, // dihitung otomatis
        'payment_method'  => $request->payment_method,
        'status'          => $request->status,
    ]);

    return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan.');
}


    /**
     * Menampilkan form untuk mengedit pesanan.
     */
    public function edit(Order $order)
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    /**
     * Memperbarui pesanan yang sudah ada.
     */
    public function update(Request $request, Order $order)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,credit',
            'status' => 'required|in:pending,processed,shipped,completed',
        ]);

        // Menghitung total_price berdasarkan harga produk dan quantity
        $product = Product::find($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        // Menambahkan total_price ke data validasi
        $validated['total_price'] = $totalPrice;

        // Perbarui data pesanan
        $order->update($validated);

        // Redirect ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui!');
    }

    /**
     * Menghapus pesanan.
     */
    public function destroy(Order $order)
    {
        // Hapus pesanan dari database
        $order->delete();

        // Redirect ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}
