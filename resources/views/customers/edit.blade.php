@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Customer</h2>
            <a href="{{ route('customers.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali</a>
        </div>

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $customer->name) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Alamat</label>
                <textarea name="address" rows="3"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">{{ old('address', $customer->address) }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</div>
@endsection
