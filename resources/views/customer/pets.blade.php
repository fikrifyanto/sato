@extends('customer.layouts.app')

@section('content')
<div x-data="petFilter()" class="flex flex-col md:flex-row gap-6">

    {{-- SIDEBAR FILTER --}}
    <aside class="w-full md:w-1/4 bg-white rounded-xl shadow p-4 h-fit">
        <h2 class="text-lg font-semibold text-gray-800 mb-3">Filter Peliharaan</h2>

        {{-- Search Nama --}}
        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-1">Cari Nama</label>
            <input type="text" x-model="search" placeholder="Cari nama anabul..."
                   class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        {{-- Filter Spesies --}}
        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-1">Spesies</label>
            <template x-for="sp in species" :key="sp">
                <div class="flex items-center space-x-2 mb-1">
                    <input type="checkbox" :value="sp" x-model="selectedSpecies"
                           class="rounded text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm text-gray-700" x-text="sp"></span>
                </div>
            </template>
        </div>

        {{-- Filter Breed --}}
        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-1">Breed</label>
            <template x-for="br in breed" :key="br">
                <div class="flex items-center space-x-2 mb-1">
                    <input type="checkbox" :value="br" x-model="selectedBreed"
                           class="rounded text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm text-gray-700" x-text="br"></span>
                </div>
            </template>
        </div>

        {{-- Rentang Harga --}}
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

        {{-- Status --}}
        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-1">Status</label>
            <select x-model="status"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua</option>
                <option value="available">Tersedia</option>
                <option value="adopted">Sudah Diadopsi</option>
            </select>
        </div>

        {{-- Status Vaksin --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Status Vaksin</label>
            <select x-model="vaccinated"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua</option>
                <option value="Sudah">Sudah</option>
                <option value="Belum">Belum</option>
            </select>
        </div>
    </aside>

    {{-- GRID PELIHARAAN --}}
    <main class="flex-1">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Pilih Teman Terbaikmu</h2>

        <div class="grid grid-cols-2 sm:grid-cols-6 lg:grid-cols-4 gap-4">
            <template x-for="pet in filteredPets()" :key="pet.id">
                <div @click="window.location.href='{{ route('pets') }}/' + pet.id" class="bg-white rounded-lg shadow hover:shadow-md transition p-3 cursor-pointer flex flex-col justify-between">
                    <div class="aspect-[1/1] overflow-hidden rounded-md">
                        <img :src="pet.image" :alt="pet.name" loading="lazy"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="mt-2">
                        <h3 class="text-sm font-medium text-gray-800 line-clamp-2" x-text="pet.name"></h3>
                        <p class="text-xs text-gray-500 mt-1" x-text="pet.species + ' • ' + pet.gender"></p>
                        <p class="text-base font-semibold text-orange-600 mt-1">
                            Rp<span x-text="formatNumber(pet.price)"></span>
                        </p>
                        <button class="py-2 px-4 shadow-sm rounded-md bg-primary text-sm text-white w-full mt-4">
                            Adopsi
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <template x-if="filteredPets().length === 0">
            <p class="text-center text-gray-500 mt-10">Tidak ada peliharaan yang cocok dengan filter.</p>
        </template>
    </main>
</div>
@endsection

@section('scripts')
<script>
function petFilter() {
    return {
        search: '',
        minPrice: 0,
        maxPrice: 10000000,
        status: '',
        vaccinated: '',
        selectedSpecies: [],
        selectedBreed: [],
        species: {!! json_encode($speciesList) !!},
        breed: {!! json_encode($breedList) !!},
        pets: {!! $petsJson !!},

        formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        },

        filteredPets() {
            return this.pets.filter(p => {
                const matchName = p.name.toLowerCase().includes(this.search.toLowerCase());
                const matchSpecies = this.selectedSpecies.length === 0 || this.selectedSpecies.includes(p.species);
                const matchBreed = this.selectedBreed.length === 0 ||
                    this.selectedBreed.some(b => b.toLowerCase() === p.breed.toLowerCase());
                const matchPrice = p.price >= this.minPrice && p.price <= this.maxPrice;
                const matchStatus = this.status === '' || p.status === this.status;
                const matchVacc = this.vaccinated === '' || p.vaccinated === this.vaccinated;
                return matchName && matchSpecies && matchBreed && matchPrice && matchStatus && matchVacc;
            });
        }
    }
}
</script>
@endsection
