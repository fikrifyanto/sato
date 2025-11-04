@extends('customer.layouts.app')

@section('content')
    <div x-data="productFilter()" class="flex flex-col md:flex-row gap-6 px-6 py-8">

        {{-- ========== SIDEBAR FILTER ========== --}}
        <aside class="w-full md:w-1/4 bg-white rounded-xl shadow p-4 h-fit">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Filter Produk</h2>

            {{-- Search Input --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Cari Produk</label>
                <input type="text" x-model="search" placeholder="Cari nama produk..."
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Filter Kategori --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Kategori</label>
                <template x-for="cat in categories" :key="cat">
                    <div class="flex items-center space-x-2 mb-1">
                        <input type="checkbox" :value="cat" x-model="selectedCategories"
                            class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm text-gray-700" x-text="cat"></span>
                    </div>
                </template>
            </div>

            {{-- Filter Harga --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Rentang Harga</label>
                <div class="flex items-center space-x-2">
                    <input type="number" min="0" x-model.number="minPrice" placeholder="Min"
                        class="w-1/2 border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <span class="text-gray-500">-</span>
                    <input type="number" min="0" x-model.number="maxPrice" placeholder="Max"
                        class="w-1/2 border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    Rp<span x-text="formatNumber(minPrice)"></span> - Rp<span x-text="formatNumber(maxPrice)"></span>
                </p>
            </div>


            {{-- Filter Stok --}}
            <div>
                <label class="block text-sm text-gray-600 mb-1">Stok</label>
                <select x-model="stockStatus"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua</option>
                    <option value="in">Tersedia</option>
                    <option value="out">Habis</option>
                </select>
            </div>
        </aside>

        {{-- ========== GRID PRODUK ========== --}}
        <main class="flex-1">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Produk Kebutuhan Hewan</h2>

            <div class="grid grid-cols-2 sm:grid-cols-6 lg:grid-cols-6 gap-4">
                <template x-for="product in filteredProducts()" :key="product.id">
                    <div @click="window.location.href='/customer/products/' + product.id" 
                        class="bg-white rounded-lg shadow hover:shadow-md transition p-3 cursor-pointer flex flex-col justify-between">
                        <div class="aspect-[1/1] overflow-hidden rounded-md">
                            <img :src="product.image" :alt="product.name"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>

                        <div class="mt-2">
                            <h3 class="text-sm font-medium text-gray-800 line-clamp-2" x-text="product.name"></h3>
                            <p class="text-base font-semibold text-orange-600 mt-1">Rp<span
                                    x-text="formatNumber(product.price)"></span></p>
                            <p class="text-xs text-gray-500 mt-1">Stock - <span x-text="product.stock_qty"></span></p>
                            <p class="text-xs text-gray-500 mt-1" x-text="product.category"></p>
                        </div>
                    </div>
                </template>
            </div>

            <template x-if="filteredProducts().length === 0">
                <p class="text-center text-gray-500 mt-10">Tidak ada produk yang cocok dengan filter.</p>
            </template>
        </main>
    </div>
@endsection


@section('scripts')
    <script>
        function productFilter() {
            return {
                search: '',
                minPrice: 0,
                maxPrice: 10000000,
                stockStatus: '',
                selectedCategories: [],
                categories: {!! json_encode($products->pluck('category')->unique()->values()) !!},

                products: {!! $productsJson !!},

                formatNumber(num) {
                    return new Intl.NumberFormat('id-ID').format(num);
                },

                filteredProducts() {
                    return this.products.filter(p => {
                        const matchName = p.name.toLowerCase().includes(this.search.toLowerCase());
                        const matchCategory = this.selectedCategories.length === 0 || this.selectedCategories
                            .includes(p.category);
                        const matchPrice = p.price >= this.minPrice && p.price <= this.maxPrice;
                        const matchStock = this.stockStatus === '' || p.stock === this.stockStatus;
                        return matchName && matchCategory && matchPrice && matchStock;
                    });
                }
            }
        }
    </script>
@endsection
