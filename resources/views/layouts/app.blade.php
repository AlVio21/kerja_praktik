<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- CoreUI CSS -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- CoreUI JS -->
        <script src="{{ asset('public/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

        <div class="flex">

            <!-- Sidebar -->
            <div class="w-64 h-screen bg-gray-800 text-white">
                <div class="py-6 px-4">
                    <h2 class="text-xl font-semibold">PT Centradist Partsindo Utama</h2>
                </div>
                <nav class="space-y-4 px-4">
                    <ul>
                        <li><a href="{{ route('orders.index') }}" class="block py-2 px-3 rounded-md hover:bg-gray-700">Orders</a></li>
                        <li><a href="{{ route('products.index') }}" class="block py-2 px-3 rounded-md hover:bg-gray-700">Products</a></li>
                        <li><a href="{{ route('customers.index') }}" class="block py-2 px-3 rounded-md hover:bg-gray-700">Customers</a></li>
                        
                    </ul>
                </nav>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-soft-blue text-gray-100">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="bg-mint-green text-gray-800">
                    @yield('content')
                </main>
            </div>
        </div>

    </body>
</html>
