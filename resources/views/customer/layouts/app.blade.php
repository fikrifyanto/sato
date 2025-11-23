<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false, profileOpen: false }" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Customer Area' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/app-logo.png') }}">
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="h-full flex flex-col min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-200 shadow-lg">
        {{-- tambahkan sedikit margin kiri-kanan agar isi tidak terlalu tengah --}}
        <div class="px-8 sm:px-10 lg:px-16">
            <div class="flex h-16 items-center justify-between">

                {{-- KIRI: Logo dan Menu --}}
                <div class="flex items-center space-x-8">
                    <a href="{{ route('customer.dashboard') }}" class="flex items-center">
                        <img src="{{ asset('images/app-logo.png') }}" alt="Logo" class="h-8 w-auto">
                        <span class="ml-2 text-gray-800 font-semibold text-lg">Sato</span>
                    </a>

                    {{-- Menu --}}
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('customer.dashboard') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium 
                            {{ request()->routeIs('customer.dashboard') ? 'text-amber-600 bg-amber-100' : 'text-amber-600 hover:bg-amber-100' }}">
                            Home
                        </a>

                        <a href="{{ route('customer.pets') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium 
                            {{ request()->routeIs('customer.pets') ? 'text-amber-600 bg-amber-100' : 'text-amber-600 hover:bg-amber-100' }}">
                            Adoption
                        </a>

                        <a href="{{ route('customer.products') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium 
                            {{ request()->routeIs('customer.products') ? 'text-amber-600 bg-amber-100' : 'text-amber-600 hover:bg-amber-100' }}">
                            Products
                        </a>
                    </div>

                </div>

                {{-- KANAN: Ikon Aksi --}}
                <div class="flex items-center space-x-6">
                    <form action="#" method="GET" class="w-full max-w-md">
                        <div class="relative">
                            <input type="text" name="q" placeholder="Search..."
                                class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 pl-10 text-sm text-gray-700 placeholder-gray-400 focus:border-amber-500 focus:ring-1 focus:ring-amber-500">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                    </form>

                    {{-- Icon Cart --}}
                    <a href="{{ route('customer.carts') }}"
                        class="relative p-1 text-gray-500 hover:text-amber-600 focus:outline-none" title="Keranjang">

                        {{-- Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                        </svg>

                        {{-- Badge Quantity --}}
                        @php
                            $cartQty = session('cart_qty', 0); // Default 0 kalau belum ada
                        @endphp

                        @if ($cartQty > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1.5">
                                {{ $cartQty }}
                            </span>
                        @endif
                    </a>

                    {{-- Icon Profile --}}
                    <div class="relative" x-data="{ open: false }">

                        <button @click="open = !open" class="p-1 text-gray-500 hover:text-amber-600 focus:outline-none"
                            title="Profil">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                <path fill-rule="evenodd"
                                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-cloak x-show="open" @click.outside="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100">

                            <a href="{{ route('customer.transactions') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Riwayat
                                Transaksi</a>
                            <a href="{{ route('customer.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Pengaturan</a>

                            <form method="POST" action="{{ route('customer.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Sign
                                    Out</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-6 text-gray-800 bg-gray-200">
        <div class="container mx-auto">
            @yield('content')
        </div>
    </main>

    <footer class="bg-gray-100 border-t border-gray-200 mt-8">
        <div class="max-w-7xl mx-auto px-4 py-4 text-center text-gray-600 text-sm">
            © {{ date('Y') }} Sato. All rights reserved.
        </div>
    </footer>


    @yield('scripts')

</body>

</html>
