@extends('customer.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8 flex flex-col md:flex-row gap-6">

    {{-- Gambar Produk --}}
    <div class="md:w-1/2">
        <div class="rounded-lg overflow-hidden shadow mb-4">
            <img src="{{ $productData['image'] }}" alt="{{ $productData['name'] }}"
                 class="w-full h-96 object-cover">
        </div>
    </div>

    {{-- Detail Info --}}
    <div class="md:w-1/2">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $productData['name'] }}</h2>
        <p class="text-gray-600 mb-1"><strong>Kategori:</strong> {{ $productData['category'] }}</p>
        <p class="text-gray-800 font-semibold text-xl mb-4">Rp{{ number_format($productData['price'],0,',','.') }}</p>
        <p class="text-gray-700 mb-4"><strong>Deskripsi:</strong> {!! $productData['description'] !!}</p>
        <p class="text-gray-600 mb-4"><strong>Stok:</strong> {{ $productData['stock_qty'] }} pcs</p>

        @if($productData['stock'] === 'in')
            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Tambah ke Keranjang
            </button>
        @else
            <button class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed" disabled>
                Stok Habis
            </button>
        @endif
    </div>

</div>
@endsection
