@extends('customer.layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-8 flex flex-col md:flex-row gap-8">

        {{-- LEFT: GAMBAR PRODUK --}}
        <div class="md:w-1/2">
            <div class="bg-white rounded-xl shadow p-4">

                {{-- Gambar Utama --}}
                <div class="rounded-lg overflow-hidden cursor-pointer"
                    onclick="document.getElementById('galleryModal').classList.remove('hidden')">
                    <img src="{{ $productData['image_main'] }}" alt="{{ $productData['name'] }}"
                        class="w-full h-96 object-cover">
                </div>

                {{-- Thumbnails --}}
                <div class="flex gap-3 mt-4">
                    @foreach ($productData['images'] as $img)
                        <img src="{{ $img }}"
                            class="w-20 h-20 rounded-lg object-cover border cursor-pointer hover:ring-2 hover:ring-amber-500"
                            onclick="document.getElementById('galleryModal').classList.remove('hidden')">
                    @endforeach
                </div>

            </div>
        </div>

        {{-- RIGHT: DETAIL PRODUK --}}
        <div class="md:w-1/2">
            <div class="bg-white rounded-xl shadow p-6">

                <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $productData['name'] }}</h2>

                <p class="text-gray-600 mb-1"><strong>Kategori:</strong> {{ $productData['category'] }}</p>
                <p class="text-amber-600 font-bold text-3xl mb-4">Rp{{ number_format($productData['price'], 0, ',', '.') }}</p>
                <p class="text-gray-700 mb-4"><strong>Deskripsi:</strong> {!! $productData['description'] !!}</p>
                <p class="text-gray-700 mb-4"><strong>Stok:</strong> {{ $productData['stock_qty'] }} pcs</p>

                @if ($productData['stock'] === 'in')
                    <button class="w-full bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700">
                        Tambah ke Keranjang
                    </button>
                @else
                    <button class="w-full bg-gray-400 text-white py-2 rounded-lg cursor-not-allowed" disabled>
                        Stok Habis
                    </button>
                @endif

            </div>
        </div>

    </div>

    {{-- MODAL GALERI --}}
    <div id="galleryModal" class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center p-4">

        <div class="bg-white rounded-lg shadow-lg p-4 max-w-3xl w-full relative">

            {{-- Tombol Close --}}
            <button class="absolute top-3 right-3 text-gray-500 hover:text-red-500"
                onclick="document.getElementById('galleryModal').classList.add('hidden')">
                ✕
            </button>

            {{-- Galeri Besar --}}
            <div class="flex flex-col items-center">
                @foreach ($productData['images'] as $img)
                    <img src="{{ $img }}" class="mb-4 rounded-lg max-h-[500px] object-contain">
                @endforeach
            </div>

        </div>

    </div>
@endsection
