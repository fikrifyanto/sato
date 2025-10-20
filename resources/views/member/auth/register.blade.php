@extends('member.layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Register Member</h2>
    <form method="POST" action="{{ route('member.register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" class="border w-full p-2 mb-3 rounded">
        <input type="email" name="email" placeholder="Email" class="border w-full p-2 mb-3 rounded">
        <input type="password" name="password" placeholder="Password" class="border w-full p-2 mb-3 rounded">
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="border w-full p-2 mb-3 rounded">
        <button class="bg-green-600 text-white w-full p-2 rounded">Daftar</button>
    </form>
</div>
@endsection
