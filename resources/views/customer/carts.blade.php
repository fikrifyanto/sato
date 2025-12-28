@php use App\Models\Product; @endphp
@extends('customer.layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col lg:flex-row gap-6">

        {{-- LEFT: LIST PRODUK CART --}}
        <div class="lg:w-2/3 space-y-4">

            {{-- Judul --}}
            <div class="bg-white p-4 rounded-xl shadow flex items-center gap-3">
                <h2 class="font-semibold text-lg">Keranjang Belanja</h2>
            </div>

            @foreach($items as $item)
                <div class="bg-white p-4 rounded-xl shadow flex items-start gap-4">
                    @php $itemable = $item->itemable; @endphp

                    <img src="{{ isset($itemable->images[0]) ? asset('storage/' . $itemable->images[0]) : ''  }}"
                         class="w-24 h-24 rounded-lg object-cover">

                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">{{ $itemable->name  }}</h3>
                        <p class="text-gray-500 text-sm">
                            @if($item->itemable_type == Product::class)
                                Produk
                            @else
                                Hewan Peliharaan
                            @endif
                        </p>

                        <p class="text-amber-600 font-bold text-xl mt-2">
                            Rp {{ number_format($itemable->price, 0, ',', '.') }}
                        </p>

                        @if($item->itemable_type == Product::class)
                            <div class="flex items-center mt-3">
                                <form action="{{ route('carts.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->itemable->id  }}">
                                    <input type="hidden" name="qty" value="{{ $item->qty - 1 }}">
                                    <button class="px-3 bg-primary text-white h-8 border border-gray-200 rounded-l-lg">
                                        -
                                    </button>
                                </form>
                                <input type="text" value="{{ $item->qty }}"
                                       class="w-12 h-8 text-center border-t border-b border-gray-200">
                                <form action="{{ route('carts.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->itemable->id  }}">
                                    <input type="hidden" name="qty" value="{{ $item->qty + 1 }}">
                                    <button class="px-3 bg-primary text-white h-8 border border-gray-200 rounded-r-lg">
                                        +
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{-- Delete --}}
                    <form action="{{ route('carts.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="lg:w-1/3">

            <div class="bg-white p-6 rounded-xl shadow space-y-4 sticky top-24">

                <h2 class="text-lg font-semibold text-gray-800">Ringkasan Belanja</h2>

                <div class="flex justify-between text-gray-900 font-bold text-lg">
                    <span>Total</span>
                    <span>
                        @php
                            $subtotal = $items->sum(function ($item) {
                                return $item->itemable->price * $item->qty;
                            })
                        @endphp

                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                    </span>
                </div>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <button type="submit" class="w-full bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700 text-lg">
                        Checkout
                    </button>
                </form>

            </div>

        </div>

    </div>
@endsection
