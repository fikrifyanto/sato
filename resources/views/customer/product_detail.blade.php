@php use App\Models\Product; @endphp
@extends('customer.layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-8 grid grid-cols-2 gap-8">

        {{-- LEFT: GAMBAR PRODUK --}}
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

        {{-- RIGHT: DETAIL PRODUK --}}
        <div class="bg-white rounded-xl shadow flex flex-col justify-between p-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $productData['name'] }}</h2>

                <p class="text-gray-600 mb-1"><strong>Kategori:</strong> {{ $productData['category'] }}</p>
                <p class="text-amber-600 font-bold text-3xl mb-4">
                    Rp {{ number_format($productData['price'], 0, ',', '.') }}</p>
                <p class="text-gray-700 mb-4"><strong>Deskripsi:</strong> {!! $productData['description'] !!}</p>
                <p class="text-gray-700 mb-4"><strong>Stok:</strong> {{ $productData['stock_qty'] }} pcs</p>
            </div>

            <div class="flex gap-2 items-center">
                <button class="w-full bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700">
                    Beli
                </button>
                <form class="relative" action="{{ route('carts.update') }}" method="POST">
                    @csrf
                    @php $item = $cartItems->where('itemable_type', Product::class)->where('itemable_id', $productData['id'])->first() @endphp
                    <input type="hidden" name="product_id" value="{{ $productData['id']  }}">
                    @if($item)
                        <input type="hidden" name="qty" value="{{ $item->qty + 1 }}">
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1.5">
                                {{ $item->qty }}
                            </span>
                    @endif
                    <button class="bg-amber-600   text-white p-2 rounded-lg hover:bg-amber-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL GALERI --}}
    <div id="galleryModal"
         class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center p-4">

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
