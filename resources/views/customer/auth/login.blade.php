@extends('customer.layouts.auth')

@section('content')
    <div class="w-full flex flex-col items-center mt-10">

        <!-- Logo + Title -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/app-logo.png') }}" alt="Your Company" class="mx-auto h-12 w-auto" />

            <h2 class="mt-4 text-2xl font-bold tracking-tight text-gray-900">
                Log In
            </h2>
        </div>

        <!-- Card Form -->
        <main class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">

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

            <form action="{{ route('customer.login') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}"
                        class="mt-2 block w-full rounded-md border @error('email') border-red-500 @else border-gray-300 @enderror px-3 py-2">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password"
                        class="mt-2 block w-full rounded-md border @error('password') border-red-500 @else border-gray-300 @enderror px-3 py-2">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-700">
                        <input type="checkbox" name="remember"
                            class="h-4 w-4 rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                        <span class="ml-2">Remember Me</span>
                    </label>

                    <a href="#" class="text-sm font-semibold text-amber-600 hover:text-amber-500">
                        Forgot password?
                    </a>
                </div>


                <button type="submit"
                    class="w-full rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white hover:bg-amber-500">
                    Sign in
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('customer.register') }}" class="font-semibold text-amber-600 hover:text-amber-500">
                    Sign Up
                </a>
            </p>

        </main>

    </div>

@endsection
