@extends('customer.layouts.app')

@section('content')
    <div>
        <div class="grid md:grid-cols-[7fr_3fr] gap-4 w-full items-stretch">
            <!-- 🟦 Carousel -->
            <div id="carousel" class="relative w-full bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64 sm:h-80 md:h-[28rem]">
                    <!-- Slide 1 -->
                    <div class="carousel-slide absolute inset-0 flex items-center justify-center bg-indigo-600 text-white p-6"
                        data-index="0" aria-hidden="false" style="opacity:1; transform:translateX(0%)">
                        <div class="max-w-2xl text-center">
                            <h3 class="text-2xl sm:text-3xl font-bold mb-2">Welcome to Member Area</h3>
                            <p class="text-sm sm:text-base opacity-90">Slide 1 — Highlight features or welcome message.</p>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-slide absolute inset-0 flex items-center justify-center bg-emerald-600 text-white p-6"
                        data-index="1" aria-hidden="true" style="opacity:0; transform:translateX(100%)">
                        <div class="max-w-2xl text-center">
                            <h3 class="text-2xl sm:text-3xl font-bold mb-2">Secure Authentication</h3>
                            <p class="text-sm sm:text-base opacity-90">Slide 2 — Short sentence about security.</p>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-slide absolute inset-0 flex items-center justify-center bg-slate-700 text-white p-6"
                        data-index="2" aria-hidden="true" style="opacity:0; transform:translateX(100%)">
                        <div class="max-w-2xl text-center">
                            <h3 class="text-2xl sm:text-3xl font-bold mb-2">Get Started Quickly</h3>
                            <p class="text-sm sm:text-base opacity-90">Slide 3 — CTA or onboarding text.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 🟩 Kanan: Card -->
            <div class="grid grid-rows-2 gap-3 h-64 sm:h-80 md:h-[28rem]">

                {{-- Card 1: Adopsi --}}
                <a href="{{ route('customer.pets') }}" class="relative rounded-xl overflow-hidden shadow-lg group block">
                    <img src="{{ asset('images/card1.jpg') }}" alt="Adopsi"
                        class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
                    <div class="absolute left-4 bottom-4 text-white">
                        <h2 class="text-lg font-semibold">Adopsi</h2>
                    </div>
                </a>

                {{-- Card 2: Produk Kebutuhan Hewan --}}
                <a href="{{ route('customer.products') }}"
                    class="relative rounded-xl overflow-hidden shadow-lg group block">
                    <img src="{{ asset('images/card2.jpg') }}" alt="Produk Kebutuhan Hewan"
                        class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
                    <div class="absolute left-4 bottom-4 text-white">
                        <h2 class="text-lg font-semibold">Produk Kebutuhan Hewan</h2>
                    </div>
                </a>

            </div>


        </div>
    </div>

    {{-- Produk Section --}}
    <div class="my-8 px-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Produk Pilihan</h2>
            <a href="{{ route('customer.products') }}" class="text-sm text-amber-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($products->take(6) as $product)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition p-3 cursor-pointer">
                    <div class="aspect-[1/1] overflow-hidden rounded-md">
                        @php
                            $imagePath = !empty($product->images) ? (is_array($product->images) ? $product->images[0] : $product->images) : null;
                            $imageExists = $imagePath && @file_exists(public_path('storage/' . $imagePath));
                        @endphp
                        @if ($imageExists)
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @else
                            <img src="https://picsum.photos/300?random={{ $product->id }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @endif
                    </div>

                    <div class="mt-2">
                        <h3 class="text-sm font-medium text-gray-800 line-clamp-2">{{ $product->name }}</h3>
                        <p class="text-base font-semibold text-orange-600 mt-1">
                            Rp{{ number_format($product->price ?? 0) }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">{{ $product->category ?? 'Aksesoris' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="my-8 px-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Pilih Teman Baikmu</h2>
            <a href="{{ route('customer.pets') }}" class="text-sm text-amber-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($pets->take(6) as $pet)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition p-3 cursor-pointer">
                    <div class="aspect-[1/1] overflow-hidden rounded-md">
                        @php
                            $petImage = !empty($pet->images) && is_array($pet->images) && count($pet->images) > 0 ? $pet->images[0] : null;
                            $petImageExists = $petImage && @file_exists(public_path('storage/' . $petImage));
                        @endphp
                        @if ($petImageExists)
                            <img src="{{ asset('storage/' . $petImage) }}" alt="{{ $pet->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @else
                            <img src="https://picsum.photos/300?random={{ $pet->id }}" alt="{{ $pet->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @endif
                    </div>

                    <div class="mt-2">
                        <h3 class="text-sm font-medium text-gray-800 line-clamp-2">{{ $pet->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ ucfirst($pet->species) }} • {{ ucfirst($pet->gender) }}
                        </p>
                        <p class="text-base font-semibold text-orange-600 mt-1">
                            Rp{{ number_format($pet->price ?? 0) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="my-8 px-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Berikan Nutrisi Terbaik Untuk Anabul</h2>
            <a href="{{ route('customer.pets') }}" class="text-sm text-amber-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($pets->take(6) as $pet)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition p-3 cursor-pointer">
                    <div class="aspect-[1/1] overflow-hidden rounded-md">
                        @php
                            $petImage = !empty($pet->images) && is_array($pet->images) && count($pet->images) > 0 ? $pet->images[0] : null;
                            $petImageExists = $petImage && @file_exists(public_path('storage/' . $petImage));
                        @endphp
                        @if ($petImageExists)
                            <img src="{{ asset('storage/' . $petImage) }}" alt="{{ $pet->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @else
                            <img src="https://picsum.photos/300?random={{ $pet->id }}" alt="{{ $pet->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @endif
                    </div>

                    <div class="mt-2">
                        <h3 class="text-sm font-medium text-gray-800 line-clamp-2">{{ $pet->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ ucfirst($pet->species) }} • {{ ucfirst($pet->gender) }}
                        </p>
                        <p class="text-base font-semibold text-orange-600 mt-1">
                            Rp{{ number_format($pet->price ?? 0) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('scripts')
    <script></script>
@endsection
