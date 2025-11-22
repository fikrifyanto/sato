@extends('customer.layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8 flex flex-col lg:flex-row gap-6">

    {{-- LEFT: LIST PRODUK CART --}}
    <div class="lg:w-2/3 space-y-4">

        {{-- Judul --}}
        <div class="bg-white p-4 rounded-xl shadow flex items-center gap-3">
            <input type="checkbox" class="w-5 h-5 cursor-pointer">
            <h2 class="font-semibold text-lg">Keranjang Belanja</h2>
        </div>

        {{-- CART ITEM 1 --}}
        <div class="bg-white p-4 rounded-xl shadow flex items-start gap-4">
            <input type="checkbox" class="w-5 h-5 mt-2 cursor-pointer">

            <img src="https://picsum.photos/100?random=1"
                 class="w-24 h-24 rounded-lg object-cover">

            <div class="flex-1">
                <h3 class="font-semibold text-gray-900">Royal Canin Indoor Cat Food 2KG</h3>
                <p class="text-gray-500 text-sm">Kategori: Makanan Kucing</p>

                <p class="text-amber-600 font-bold text-xl mt-2">
                    Rp220.000
                </p>

                {{-- Qty Selector --}}
                <div class="flex items-center mt-3">
                    <button class="px-3 py-1 border rounded-l-lg">-</button>
                    <input type="text" value="1"
                           class="w-12 text-center border-t border-b">
                    <button class="px-3 py-1 border rounded-r-lg">+</button>
                </div>
            </div>

            {{-- Delete --}}
            <button class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
        </div>

        {{-- CART ITEM 2 --}}
        <div class="bg-white p-4 rounded-xl shadow flex items-start gap-4">
            <input type="checkbox" class="w-5 h-5 mt-2 cursor-pointer">

            <img src="https://picsum.photos/100?random=2"
                 class="w-24 h-24 rounded-lg object-cover">

            <div class="flex-1">
                <h3 class="font-semibold text-gray-900">Kalung Kucing Anti Hilang GPS Tracker</h3>
                <p class="text-gray-500 text-sm">Kategori: Aksesoris Kucing</p>

                <p class="text-amber-600 font-bold text-xl mt-2">
                    Rp150.000
                </p>

                {{-- Qty Selector --}}
                <div class="flex items-center mt-3">
                    <button class="px-3 py-1 border rounded-l-lg">-</button>
                    <input type="text" value="2"
                           class="w-12 text-center border-t border-b">
                    <button class="px-3 py-1 border rounded-r-lg">+</button>
                </div>
            </div>

            {{-- Delete --}}
            <button class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
        </div>

        {{-- CART ITEM 3 --}}
        <div class="bg-white p-4 rounded-xl shadow flex items-start gap-4">
            <input type="checkbox" class="w-5 h-5 mt-2 cursor-pointer">

            <img src="https://picsum.photos/100?random=3"
                 class="w-24 h-24 rounded-lg object-cover">

            <div class="flex-1">
                <h3 class="font-semibold text-gray-900">Pasir Kucing Wangi Lavender 10L</h3>
                <p class="text-gray-500 text-sm">Kategori: Perlengkapan</p>

                <p class="text-amber-600 font-bold text-xl mt-2">
                    Rp75.000
                </p>

                {{-- Qty Selector --}}
                <div class="flex items-center mt-3">
                    <button class="px-3 py-1 border rounded-l-lg">-</button>
                    <input type="text" value="1"
                           class="w-12 text-center border-t border-b">
                    <button class="px-3 py-1 border rounded-r-lg">+</button>
                </div>
            </div>

            {{-- Delete --}}
            <button class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
        </div>

    </div>

    {{-- RIGHT: RINGKASAN BELANJA --}}
    <div class="lg:w-1/3">

        <div class="bg-white p-6 rounded-xl shadow space-y-4 sticky top-24">

            <h2 class="text-lg font-semibold text-gray-800">Ringkasan Belanja</h2>

            <div class="flex justify-between text-gray-600">
                <span>Total Harga Barang</span>
                <span>Rp445.000</span>
            </div>

            <div class="flex justify-between text-gray-600">
                <span>Biaya Pengiriman</span>
                <span>Rp30.000</span>
            </div>

            <hr>

            <div class="flex justify-between text-gray-900 font-bold text-lg">
                <span>Total Pembayaran</span>
                <span>Rp475.000</span>
            </div>

            <button class="w-full bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700 text-lg">
                Checkout
            </button>

        </div>

    </div>

</div>
@endsection
