@extends('customer.layouts.auth')

@section('content')
    <div class="w-full flex flex-col items-center">

        <!-- Logo + Title -->
        <div class="sm:w-full sm:max-w-sm mt-10 text-center">
            <img src="{{ asset('images/app-logo.png') }}" alt="Your Company" class="mx-auto h-10 w-auto" />

            <h2 class="mt-4 text-2xl font-bold tracking-tight text-gray-900">
                Create as Account
            </h2>
        </div>

        <!-- CARD -->
        <main class="w-full max-w-md bg-white p-6 mt-8 rounded-lg shadow-md">

            @if ($errors->any())
                <div class="mb-6 rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10A8 8 0 11.002 9.999 8 8 0 0118 10zm-8-3a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 7zm0 7a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan:</h3>
                            <ul class="mt-2 list-disc pl-5 text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('customer.register') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input name="name" required class="mt-2 block w-full rounded-md border border-gray-300 px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input name="email" type="email" required
                        class="mt-2 block w-full rounded-md border border-gray-300 px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input name="password" type="password" required
                        class="mt-2 block w-full rounded-md border border-gray-300 px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input name="password_confirmation" type="password" required
                        class="mt-2 block w-full rounded-md border border-gray-300 px-3 py-2" />
                </div>

                <button type="submit"
                    class="w-full rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white hover:bg-amber-500">
                    Sign Up
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('customer.login') }}" class="font-semibold text-amber-600 hover:text-amber-500">
                    Log In
                </a>
            </p>

        </main>

    </div>

    {{-- <div class="max-w-md mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Register Customer</h2>
    <form method="POST" action="{{ route('customer.register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" class="border w-full p-2 mb-3 rounded">
        <input type="email" name="email" placeholder="Email" class="border w-full p-2 mb-3 rounded">
        <input type="password" name="password" placeholder="Password" class="border w-full p-2 mb-3 rounded">
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="border w-full p-2 mb-3 rounded">
        <button class="bg-green-600 text-white w-full p-2 rounded">Daftar</button>
    </form>
</div> --}}
@endsection
