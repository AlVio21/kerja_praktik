<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Menu</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">Product</a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}"
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">Order</a>
                    </li>
                    <li>
                        <a href="{{ route('customers.index') }}"
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">Customer</a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
