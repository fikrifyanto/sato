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
            <div class="grid grid-rows-3 gap-3 h-64 sm:h-80 md:h-[28rem]">
                @foreach (['Adopsi', 'Makanan Hewan', 'Aksesoris'] as $title)
                    <div class="relative rounded-xl overflow-hidden shadow-lg group">
                        <img src="{{ asset('images/card1.jpg') }}" alt="{{ $title }}"
                            class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
                        <div class="absolute left-4 bottom-4 text-white">
                            <h2 class="text-lg font-semibold">{{ $title }}</h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Produk Section --}}
    <div class="my-8 px-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Pilih Teman Baikmu</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach (range(1, 6) as $i)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition p-3 cursor-pointer">
                    <div class="aspect-[1/1] overflow-hidden rounded-md">
                        <img src="https://picsum.photos/300?random={{ $i }}" alt="Produk {{ $i }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="mt-2">
                        <h3 class="text-sm font-medium text-gray-800 line-clamp-2">Nama Produk {{ $i }}</h3>
                        <p class="text-base font-semibold text-orange-600 mt-1">
                            Rp{{ number_format(120000 + $i * 5000) }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Jakarta</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <div
                class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg shadow transition cursor-pointer w-full py-2 text-center">
                Lihat Selengkapnya
            </div>
        </div>
    </div>

    <div class="my-8 px-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Berikan Nutrisi Anabul</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach (range(1, 6) as $i)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition p-3 cursor-pointer">
                    <div class="aspect-[1/1] overflow-hidden rounded-md">
                        <img src="https://picsum.photos/300?random={{ $i }}" alt="Produk {{ $i }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="mt-2">
                        <h3 class="text-sm font-medium text-gray-800 line-clamp-2">Nama Produk {{ $i }}</h3>
                        <p class="text-base font-semibold text-orange-600 mt-1">
                            Rp{{ number_format(120000 + $i * 5000) }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Jakarta</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <div
                class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg shadow transition cursor-pointer w-full py-2 text-center">
                Lihat Selengkapnya
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script></script>
@endsection
