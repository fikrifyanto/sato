@extends('customer.layouts.auth')

@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="{{ asset('images/app-logo.png') }}" alt="Sato" class="mx-auto h-10 w-auto"/>
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Buat akun baru</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                    <div class="mt-2">
                        <input id="name" type="text" name="name" required
                               value="{{ old('name') }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary sm:text-sm/6 @error('name') border-red-500 @enderror"/>
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                    <div class="mt-2">
                        <input id="email" type="email" name="email" required autocomplete="email"
                               value="{{ old('email') }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary sm:text-sm/6 @error('email') border-red-500 @enderror"/>
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" type="password" name="password" required
                               value="{{ old('password') }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary sm:text-sm/6 @error('password') border-red-500 @enderror"/>
                        @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Konfirmasi Password</label>
                    <div class="mt-2">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               value="{{ old('password_confirmation') }}"
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary sm:text-sm/6 @error('password_confirmation') border-red-500 @enderror"/>
                        @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="flex w-full justify-center rounded-md bg-primary px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                        Buat Akun
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login')  }}" class="font-semibold text-primary hover:text-primary">Masuk</a>
            </p>
        </div>
    </div>

@endsection
