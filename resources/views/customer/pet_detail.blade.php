@extends('customer.layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="flex flex-col md:flex-row gap-6">

            {{-- Gambar --}}
            <div class="md:w-1/2">
                <div class="rounded-lg overflow-hidden shadow mb-4">
                    <img src="{{ $petData['image'] }}" alt="{{ $petData['name'] }}" class="w-full h-96 object-cover">
                </div>
            </div>



            {{-- Detail Info --}}
            <div class="md:w-1/2">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $petData['name'] }}</h2>
                <p class="text-gray-600 mb-1"><strong>Spesies:</strong> {{ $petData['species'] }}</p>
                <p class="text-gray-600 mb-1"><strong>Breed:</strong> {{ $petData['breed'] }}</p>
                <p class="text-gray-600 mb-1"><strong>Gender:</strong> {{ $petData['gender'] }}</p>
                <p class="text-gray-600 mb-1"><strong>Status Vaksin:</strong> {{ $petData['vaccinated'] }}</p>
                <p class="text-gray-600 mb-1"><strong>Status Adopsi:</strong> {{ ucfirst($petData['status']) }}</p>
                <p class="text-gray-800 font-semibold text-xl mb-4">Rp{{ number_format($petData['price'], 0, ',', '.') }}
                </p>
                <p class="text-gray-700 mb-4"><strong>Deskripsi:</strong> {!! $petData['description'] !!}</p>

                @if ($petData['stock'] === 'in')
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Ajukan Adopsi
                    </button>
                @else
                    <button class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed" disabled>
                        Sudah Diadopsi
                    </button>
                @endif
            </div>

        </div>
    </div>
@endsection
