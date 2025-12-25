<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Sato' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/app-logo.png') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css"/>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="h-full flex flex-col min-h-screen font-sans">

<nav class="bg-white border-b border-gray-200">
    <div class="px-6 sm:px-10 lg:px-16">
        <div class="flex h-16 items-center justify-between space-x-8">

            <div class="flex items-center space-x-14">
                <a href="{{ route('dashboard') }}" class="items-center hidden md:flex">
                    <img src="{{ asset('images/app-logo.png') }}" alt="Logo" class="h-8 w-auto">
                    <span class="ml-2 text-gray-900 font-bold text-lg">Sato</span>
                </a>

                <form action="#" method="GET" class="w-full max-w-md">
                    <div class="relative">
                        <input type="text" name="q" placeholder="Search"
                               class="w-full rounded-md bg-white px-3 py-2.5 pl-10 text-sm text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary sm:text-sm/6">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                             stroke="currentColor"
                             class="absolute left-3 top-1/2 -translate-y-1/2 size-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                        </svg>
                    </div>
                </form>
            </div>

            <div class="flex items-center space-x-3 md:space-x-6 text-gray-600">
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/>
                    </svg>
                </a>

                <a href="{{ route('carts') }}" class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                    </svg>

                    @php
                        $cartQty = session('cart_qty', 0); // Default 0 kalau belum ada
                    @endphp

                    @if ($cartQty > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1.5">
                                {{ $cartQty }}
                            </span>
                    @endif
                </a>

                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</nav>

<main class="flex-1 p-6 text-gray-800 bg-gray-100">
    <div class="container mx-auto">
        @yield('content')
    </div>
</main>

<footer class="bg-white mt-8">
    <div class="max-w-7xl mx-auto px-4 py-4 text-center text-gray-600 text-sm">
        © {{ date('Y') }} Sato. All rights reserved.
    </div>
</footer>


@yield('scripts')

</body>

</html>
