@extends('member.layouts.app')

@section('content')
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold mb-2">Halo, {{ Auth::guard('member')->user()->name }} 👋</h1>
        <p class="text-gray-600">Selamat datang di aplikasi Sato</p>
    </div>

    <div class="grid md:grid-cols-3 gap-4 mt-6">
        <div class="bg-white shadow rounded p-4">
            <h2 class="font-semibold text-gray-700 mb-2">Status Akun</h2>
            <p class="text-gray-500">Aktif sejak {{ Auth::guard('member')->user()->created_at->format('d M Y') }}</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="font-semibold text-gray-700 mb-2">Pesan Terbaru</h2>
            <p class="text-gray-500">Belum ada pesan.</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="font-semibold text-gray-700 mb-2">Poin Member</h2>
            <p class="text-gray-500">0 poin</p>
        </div>
    </div>
@endsection
