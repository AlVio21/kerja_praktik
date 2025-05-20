<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
    
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }
    
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
    
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
        return view('customers.create');
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
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    public function edit(Customer $customer)
    {
        /** @var User $user */
        $user = Auth::user();
    
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        /** @var User $user */
        $user = Auth::user();
    
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Customer berhasil diperbarui!');
    }

    
}
