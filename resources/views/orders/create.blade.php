@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Order</h2>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Customer</label>
                <select name="customer_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Produk</label>
                <select name="product_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Jumlah</label>
                <input type="number" name="quantity" min="1" required class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Metode Pembayaran</label>
                <select name="payment_method" required class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                    <option value="credit">Credit</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Status</label>
                <select name="status" required class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan Order
            </button>
        </form>
    </div>
</div>
@endsection
