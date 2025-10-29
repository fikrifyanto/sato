<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false, profileOpen: false }" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Member Area' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/app-logo.png') }}">
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="h-full flex flex-col min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        {{-- tambahkan sedikit margin kiri-kanan agar isi tidak terlalu tengah --}}
        <div class="px-8 sm:px-10 lg:px-16">
            <div class="flex h-16 items-center justify-between">

                {{-- KIRI: Logo dan Menu --}}
                <div class="flex items-center space-x-8">
                    <a href="{{ route('member.dashboard') }}" class="flex items-center">
                        <img src="{{ asset('images/app-logo.png') }}" alt="Logo" class="h-8 w-auto">
                        <span class="ml-2 text-gray-800 font-semibold text-lg">Member Area</span>
                    </a>

                    {{-- Menu --}}
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('member.dashboard') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-indigo-600 bg-indigo-50">Home</a>
                        <a href="#"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900">Projects</a>
                        <a href="#"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900">Reports</a>
                    </div>
                </div>

                {{-- KANAN: Ikon Aksi --}}
                <div class="flex items-center space-x-6">
                    <form action="#" method="GET" class="w-full max-w-md">
                        <div class="relative">
                            <input type="text" name="q" placeholder="Search..."
                                class="w-full rounded-full border border-gray-300 bg-gray-50 px-4 py-2 pl-10 text-sm text-gray-700 placeholder-gray-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M21.7883 21.7883C22.0706 21.506 22.0706 21.0483 21.7883 20.7659L18.1224 17.1002C19.4884 15.5007 20.3133 13.425 20.3133 11.1566C20.3133 6.09956 16.2137 2 11.1566 2C6.09956 2 2 6.09956 2 11.1566C2 16.2137 6.09956 20.3133 11.1566 20.3133C13.4249 20.3133 15.5006 19.4885 17.1 18.1225L20.7659 21.7883C21.0483 22.0706 21.506 22.0706 21.7883 21.7883Z" />
                            </svg>
                        </div>
                    </form>

                    {{-- Icon Struk --}}
                    <button class="p-1 text-gray-500 hover:text-indigo-600 focus:outline-none"
                        title="Riwayat Transaksi">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M2 5C2 4.05719 2 3.58579 2.29289 3.29289C2.58579 3 3.05719 3 4 3H20C20.9428 3 21.4142 3 21.7071 3.29289C22 3.58579 22 4.05719 22 5C22 5.94281 22 6.41421 21.7071 6.70711C21.4142 7 20.9428 7 20 7H4C3.05719 7 2.58579 7 2.29289 6.70711C2 6.41421 2 5.94281 2 5Z" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M20.0689 8.49993C20.2101 8.49999 20.3551 8.50005 20.5 8.49805V12.9999C20.5 16.7711 20.5 18.6568 19.3284 19.8283C18.1569 20.9999 16.2712 20.9999 12.5 20.9999H11.5C7.72876 20.9999 5.84315 20.9999 4.67157 19.8283C3.5 18.6568 3.5 16.7711 3.5 12.9999V8.49805C3.64488 8.50005 3.78999 8.49999 3.93114 8.49993H20.0689ZM9 11.9999C9 11.5339 9 11.301 9.07612 11.1172C9.17761 10.8722 9.37229 10.6775 9.61732 10.576C9.80109 10.4999 10.0341 10.4999 10.5 10.4999H13.5C13.9659 10.4999 14.1989 10.4999 14.3827 10.576C14.6277 10.6775 14.8224 10.8722 14.9239 11.1172C15 11.301 15 11.5339 15 11.9999C15 12.4658 15 12.6988 14.9239 12.8826C14.8224 13.1276 14.6277 13.3223 14.3827 13.4238C14.1989 13.4999 13.9659 13.4999 13.5 13.4999H10.5C10.0341 13.4999 9.80109 13.4999 9.61732 13.4238C9.37229 13.3223 9.17761 13.1276 9.07612 12.8826C9 12.6988 9 12.4658 9 11.9999Z" />
                        </svg>
                    </button>

                    {{-- Icon Cart --}}
                    <button class="relative p-1 text-gray-500 hover:text-indigo-600 focus:outline-none"
                        title="Keranjang">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M2.23737 2.28845C1.84442 2.15746 1.41968 2.36983 1.28869 2.76279C1.15771 3.15575 1.37008 3.58049 1.76303 3.71147L2.02794 3.79978C2.70435 4.02524 3.15155 4.17551 3.481 4.32877C3.79296 4.47389 3.92784 4.59069 4.01426 4.71059C4.10068 4.83049 4.16883 4.99538 4.20785 5.33722C4.24907 5.69823 4.2502 6.17 4.2502 6.883L4.2502 9.55484C4.25018 10.9224 4.25017 12.0247 4.36673 12.8917C4.48774 13.7918 4.74664 14.5497 5.34855 15.1516C5.95047 15.7535 6.70834 16.0124 7.60845 16.1334C8.47542 16.25 9.57773 16.25 10.9453 16.25H18.0002C18.4144 16.25 18.7502 15.9142 18.7502 15.5C18.7502 15.0857 18.4144 14.75 18.0002 14.75H11.0002C9.56479 14.75 8.56367 14.7484 7.80832 14.6468C7.07455 14.5482 6.68598 14.3677 6.40921 14.091C6.17403 13.8558 6.00839 13.5398 5.9034 13H16.0222C16.9817 13 17.4614 13 17.8371 12.7522C18.2128 12.5045 18.4017 12.0636 18.7797 11.1817L19.2082 10.1817C20.0177 8.2929 20.4225 7.34849 19.9779 6.67422C19.5333 5.99996 18.5058 5.99996 16.4508 5.99996H5.74526C5.73936 5.69227 5.72644 5.41467 5.69817 5.16708C5.64282 4.68226 5.52222 4.2374 5.23112 3.83352C4.94002 3.42965 4.55613 3.17456 4.1137 2.96873C3.69746 2.7751 3.16814 2.59868 2.54176 2.38991L2.23737 2.28845Z" />
                            <path
                                d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" />
                            <path
                                d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" />
                        </svg>
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1.5">2</span>
                    </button>

                    {{-- Icon Profile --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="p-1 text-gray-500 hover:text-indigo-600 focus:outline-none"
                            title="Profil">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                <circle cx="12" cy="6" r="4" />
                                <ellipse cx="12" cy="17" rx="7" ry="4" />
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Pengaturan</a>
                            <form method="POST" action="{{ route('member.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Logout</button>
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
