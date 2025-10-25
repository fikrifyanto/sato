@extends('member.layouts.auth')

@section('content')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company"
                class="mx-auto h-10 w-auto" />
            <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">
                Sign up new account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('member.register') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" required
                            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>
                
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign Up
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-600">
                Already a member?
                <a href="{{ route('member.login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign
                    In</a>
            </p>
        </div>
    </div>
{{-- <div class="max-w-md mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Register Member</h2>
    <form method="POST" action="{{ route('member.register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" class="border w-full p-2 mb-3 rounded">
        <input type="email" name="email" placeholder="Email" class="border w-full p-2 mb-3 rounded">
        <input type="password" name="password" placeholder="Password" class="border w-full p-2 mb-3 rounded">
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="border w-full p-2 mb-3 rounded">
        <button class="bg-green-600 text-white w-full p-2 rounded">Daftar</button>
    </form>
</div> --}}
@endsection
