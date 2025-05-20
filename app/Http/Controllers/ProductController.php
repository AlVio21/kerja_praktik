<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
    
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
        return view('products.create');
    }

    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
    
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:mobil,motor',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        /** @var User $user */
        $user = Auth::user();
    
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        /** @var User $user */
        $user = Auth::user();
    
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:mobil,motor',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }
}
