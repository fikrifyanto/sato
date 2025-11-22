@extends('customer.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Detail Transaksi</h2>
        <span class="text-sm text-gray-500">Order ID: <strong>TRX20250101</strong></span>
    </div>

    <!-- Status -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Status Pesanan</p>
                <p class="text-lg font-semibold text-amber-600">Selesai</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Tanggal</p>
                <p class="text-base font-semibold text-gray-800">21 Nov 2025, 14:32</p>
            </div>
        </div>
    </div>

    <!-- Product List -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h3 class="font-semibold text-gray-800 mb-4">Produk</h3>

        <!-- Product Item -->
        <div class="flex gap-4 border-b pb-4 mb-4">
            <img src="https://picsum.photos/120" class="w-24 h-24 rounded object-cover border" />
            <div class="flex-1">
                <p class="font-semibold text-gray-800">Dog Food Premium 2KG</p>
                <p class="text-sm text-gray-500">Variasi: Original</p>
                <p class="text-sm text-gray-500">Jumlah: 1</p>
            </div>
            <div class="text-right">
                <p class="font-semibold text-gray-800">Rp 120.000</p>
            </div>
        </div>

        <!-- Product Item -->
        <div class="flex gap-4 border-b pb-4 mb-4">
            <img src="https://picsum.photos/121" class="w-24 h-24 rounded object-cover border" />
            <div class="flex-1">
                <p class="font-semibold text-gray-800">Kandang Stainless Medium</p>
                <p class="text-sm text-gray-500">Variasi: Silver</p>
                <p class="text-sm text-gray-500">Jumlah: 1</p>
            </div>
            <div class="text-right">
                <p class="font-semibold text-gray-800">Rp 450.000</p>
            </div>
        </div>
    </div>

    <!-- Payment Info -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h3 class="font-semibold text-gray-800 mb-4">Ringkasan Pembayaran</h3>
        
        <div class="flex justify-between text-sm mb-1">
            <p class="text-gray-700">Subtotal</p>
            <p>Rp 570.000</p>
        </div>
        <div class="flex justify-between text-sm mb-1">
            <p class="text-gray-700">Ongkir</p>
            <p>Rp 20.000</p>
        </div>
        <div class="flex justify-between text-sm mb-1">
            <p class="text-gray-700">Diskon</p>
            <p>- Rp 10.000</p>
        </div>

        <hr class="my-3">

        <div class="flex justify-between font-semibold text-base">
            <p class="text-gray-800">Total Akhir</p>
            <p class="text-amber-600">Rp 580.000</p>
        </div>
    </div>

    <!-- Shipping Info -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h3 class="font-semibold text-gray-800 mb-4">Informasi Pengiriman</h3>
        
        <p class="text-sm text-gray-600 mb-1">Nama: <strong class="text-gray-800">Andre Prasetyo</strong></p>
        <p class="text-sm text-gray-600 mb-1">Telepon: <strong class="text-gray-800">081234567890</strong></p>
        <p class="text-sm text-gray-600">
            Alamat:<br>
            <strong class="text-gray-800">
                Jl. Merdeka No. 11, Bandung, Jawa Barat  
                (Kode Pos: 40111)
            </strong>
        </p>
    </div>

    <!-- Back -->
    <div class="text-center mt-6">
        <a href="{{ route('customer.transactions') }}"
            class="px-5 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 shadow">
            Kembali
        </a>
    </div>

</div>
@endsection
