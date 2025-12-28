@extends('customer.layouts.app')

@section('content')
    <div>
        <div class="grid md:grid-cols-[7fr_3fr] gap-4 w-full items-stretch">
            <!-- 🟦 Carousel -->
            <div id="carousel" x-data="carousel()" x-init="start()"
                class="relative w-full bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64 sm:h-80 md:h-[28rem]">

                    <!-- Slide 1 -->
                    <div class="absolute inset-0 flex items-center justify-center text-white p-6 bg-cover bg-center"
                        style="background-image: url('{{ asset('images/carousel_1.jpg') }}')" x-show="active === 0"
                        x-transition:enter="transition ease-in-out duration-700"
                        x-transition:enter-start="opacity-0 translate-x-full"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in-out duration-700"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-full">
                        <div class="max-w-2xl text-center bg-black/50 p-6 rounded-xl">
                            <h3 class="text-2xl sm:text-3xl font-bold mb-2">
                                Temukan Sahabat Setia Anda
                            </h3>
                            <p class="text-sm sm:text-base opacity-90">
                                Adopsi hewan sehat dan terawat, siap menjadi bagian dari keluarga Anda.
                            </p>
                        </div>
                    </div>


                    <!-- Slide 2 -->
                    <div class="absolute inset-0 flex items-center justify-center text-white p-6 bg-cover bg-center"
                        style="background-image: url('{{ asset('images/carousel_2.jpg') }}')" x-show="active === 1"
                        x-transition:enter="transition ease-in-out duration-700"
                        x-transition:enter-start="opacity-0 translate-x-full"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in-out duration-700"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-full">
                        <div class="max-w-2xl text-center bg-black/50 p-6 rounded-xl">
                            <h3 class="text-2xl sm:text-3xl font-bold mb-2">
                                Nutrisi Terbaik untuk Hewan Kesayangan
                            </h3>
                            <p class="text-sm sm:text-base opacity-90">
                                Pilihan makanan berkualitas untuk mendukung kesehatan dan pertumbuhan hewan Anda.
                            </p>
                        </div>
                    </div>


                    <!-- Slide 3 -->
                    <div class="absolute inset-0 flex items-center justify-center text-white p-6 bg-cover bg-center"
                        style="background-image: url('{{ asset('images/carousel_3.jpg') }}')" x-show="active === 2"
                        x-transition:enter="transition ease-in-out duration-700"
                        x-transition:enter-start="opacity-0 translate-x-full"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in-out duration-700"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-full">
                        <div class="max-w-2xl text-center bg-black/50 p-6 rounded-xl">
                            <h3 class="text-2xl sm:text-3xl font-bold mb-2">
                                Lengkapi Kebutuhan Hewan Anda
                            </h3>
                            <p class="text-sm sm:text-base opacity-90">
                                Dari aksesoris, mainan, hingga perlengkapan harian—semua tersedia di satu tempat.
                            </p>
                        </div>
                    </div>


                </div>
            </div>


            <!-- 🟩 Kanan: Card -->
            <div class="grid grid-rows-2 gap-3 h-64 sm:h-80 md:h-[28rem]">

                {{-- Card 1: Adopsi --}}
                <a href="{{ route('pets') }}" class="relative rounded-xl overflow-hidden shadow-lg group block">
                    <img src="{{ asset('images/card1.jpg') }}" alt="Adopsi"
                        class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
                    <div class="absolute left-4 bottom-4 text-white">
                        <h2 class="text-lg font-semibold">Adopsi</h2>
                    </div>
                </a>

                {{-- Card 2: Produk Kebutuhan Hewan --}}
                <a href="{{ route('products') }}" class="relative rounded-xl overflow-hidden shadow-lg group block">
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

    <div class="my-8">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Pilih Teman Baikmu</h2>
            <a href="{{ route('pets') }}" class="text-sm text-amber-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($pets->take(6) as $pet)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition p-3">
                    <a href="{{ route('pet_detail', $pet->id) }}"
                        class="block aspect-[1/1] overflow-hidden rounded-md cursor-pointer">
                        @php
                            $petImage =
                                !empty($pet->images) && is_array($pet->images) && count($pet->images) > 0
                                    ? $pet->images[0]
                                    : null;
                            $petImageExists = $petImage && @file_exists(public_path('storage/' . $petImage));
                        @endphp
                        @if ($petImageExists)
                            <img src="{{ asset('storage/' . $petImage) }}" alt="{{ $pet->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @else
                            <img src="https://picsum.photos/300?random={{ $pet->id }}" alt="{{ $pet->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @endif
                    </a>

                    <div class="mt-2">
                        <h3 class="text-sm font-medium text-gray-800 line-clamp-2">{{ $pet->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ ucfirst($pet->species) }} • {{ ucfirst($pet->gender) }}
                        </p>
                        <p class="text-base font-semibold text-orange-600 mt-1">
                            Rp {{ number_format($pet->price ?? 0, 0, ',', '.') }}
                        </p>
                        <button type="button" class="flex w-full justify-center rounded-md bg-primary px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-3">
                            Adopsi
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="my-8">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Berikan Nutrisi Terbaik Untuk Anabul</h2>
            <a href="{{ route('products') }}" class="text-sm text-amber-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($products->take(6) as $product)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition p-3">
                    <a href="{{ route('product_detail', $product->id) }}"
                        class="block aspect-[1/1] overflow-hidden rounded-md cursor-pointer">
                        @php
                            $imagePath = !empty($product->images)
                                ? (is_array($product->images)
                                    ? $product->images[0]
                                    : $product->images)
                                : null;
                            $imageExists = $imagePath && @file_exists(public_path('storage/' . $imagePath));
                        @endphp
                        @if ($imageExists)
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @else
                            <img src="https://picsum.photos/300?random={{ $product->id }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @endif
                    </a>

                    <div class="mt-2">
                        <h3 class="text-sm font-medium text-gray-800 line-clamp-2">{{ $product->name }}</h3>
                        <p class="text-base font-semibold text-orange-600 mt-1">
                            Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">{{ $product->category ?? 'Aksesoris' }}</p>
                        <button class="flex w-full justify-center rounded-md bg-primary px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary mt-3">
                            Beli
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function carousel() {
            return {
                active: 0,
                total: 3,
                timer: null,

                start() {
                    this.timer = setInterval(() => {
                        this.active = (this.active + 1) % this.total;
                    }, 4000);
                }
            }
        }
    </script>
@endsection
