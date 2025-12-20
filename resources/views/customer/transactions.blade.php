@extends('customer.layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 pb-12">
    <h1 class="text-2xl font-semibold text-gray-900 mb-5">Riwayat Transaksi</h1>

    @php
        $statusMeta = [
            'completed' => [
                'label' => 'Berhasil',
                'badge' => 'bg-emerald-100 text-emerald-700',
                'dot' => 'bg-emerald-500',
            ],
            'pending' => [
                'label' => 'Berlangsung',
                'badge' => 'bg-orange-100 text-orange-600',
                'dot' => 'bg-orange-500',
            ],
            'cancelled' => [
                'label' => 'Tidak Berhasil',
                'badge' => 'bg-rose-100 text-rose-700',
                'dot' => 'bg-rose-500',
            ],
        ];
    @endphp

    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm">
        <form method="GET" action="{{ route('customer.transactions') }}" class="px-6 py-6 space-y-5">
            <div class="grid gap-4 md:grid-cols-[minmax(0,1fr)_220px]">
                <label class="flex flex-col gap-2">
                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Cari transaksi</span>
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="w-full rounded-2xl border border-transparent bg-gray-50 focus:border-orange-400 focus:ring-2 focus:ring-orange-200 pl-11 pr-4 py-2 text-sm text-gray-700"
                            placeholder="Cari ID atau nama item"
                        >
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-orange-400" viewBox="0 0 20 20" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 3.5a5.5 5.5 0 1 1 0 11 5.5 5.5 0 0 1 0-11Zm0 1.5a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" fill="currentColor" />
                            <path d="m13.5 13.5 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </div>
                </label>

                <label class="flex flex-col gap-2">
                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Produk</span>
                    <select
                        name="product"
                        class="rounded-2xl border border-transparent bg-gray-50 focus:border-orange-400 focus:ring-2 focus:ring-orange-200 py-2 px-3 text-sm text-gray-700"
                    >
                        <option value="">Semua Jenis</option>
                        <option value="product" {{ request('product') === 'product' ? 'selected' : '' }}>Produk</option>
                        <option value="adoption" {{ request('product') === 'adoption' ? 'selected' : '' }}>Adoption</option>
                    </select>
                </label>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                @foreach($statusFilters as $statusKey => $statusLabel)
                    @php
                        $isActive = $selectedStatus === $statusKey;
                        $buttonClasses = $isActive
                            ? 'bg-orange-500 text-white border-orange-500 shadow-sm'
                            : 'bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200';
                    @endphp
                    <button
                        type="submit"
                        name="status"
                        value="{{ $statusKey }}"
                        class="px-3 py-1.5 rounded-full border text-xs sm:text-sm font-medium transition {{ $buttonClasses }}"
                    >
                        {{ $statusLabel }}
                    </button>
                @endforeach

                @if(request()->hasAny(['status', 'search', 'product']))
                    <a
                        href="{{ route('customer.transactions') }}"
                        class="ml-auto text-sm font-medium text-orange-500 hover:text-orange-600"
                    >
                        Reset Filter
                    </a>
                @endif
            </div>
        </form>

        <div class="border-t border-gray-100">
            @forelse($transactions as $trx)
                @php
                    $meta = $statusMeta[$trx['status']] ?? [
                        'label' => ucfirst($trx['status']),
                        'badge' => 'bg-gray-100 text-gray-600',
                        'dot' => 'bg-gray-400',
                    ];
                    $firstItem = $trx['items'][0] ?? null;
                @endphp

                <div class="px-6 py-6 border-b last:border-b-0 border-gray-100">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:gap-6">
                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <span class="inline-flex items-center gap-2 text-gray-600">
                                    <svg class="h-5 w-5 text-orange-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M3.75 4.5h2.25l1.5 12h9l1.5-9h-12" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11 19.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" />
                                    </svg>
                                    Belanja
                                </span>
                                <span class="text-gray-300">•</span>
                                <span>{{ \Carbon\Carbon::parse($trx['date'])->translatedFormat('d M Y') }}</span>
                                <span class="text-gray-300">•</span>
                                <span>{{ $trx['id'] }}</span>
                            </div>

                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold {{ $meta['badge'] }}">
                                <span class="h-2 w-2 rounded-full {{ $meta['dot'] }}"></span>
                                {{ $meta['label'] }}
                            </span>
                        </div>

                        <div class="flex flex-col items-start gap-2 sm:flex-row sm:items-center sm:gap-4">
                            <div class="text-right sm:text-left">
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Total Belanja</p>
                                <p class="text-base font-semibold text-gray-900">Rp{{ number_format($trx['total'], 0, ',', '.') }}</p>
                            </div>
                            <a
                                href="{{ route('customer.products') }}"
                                class="whitespace-nowrap rounded-full border border-orange-200 px-4 py-2 text-sm font-semibold text-orange-600 hover:bg-orange-50"
                            >
                                Beli Lagi
                            </a>
                        </div>
                    </div>

                    <div class="mt-5 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div class="flex items-start gap-4">
                            <div class="hidden h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl bg-gray-100 md:flex items-center justify-center">
                                <svg class="h-8 w-8 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25">
                                    <path d="M4 7h16M4 12h16M4 17h10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ $firstItem['name'] ?? 'Produk tidak tersedia' }}
                                    @if($firstItem && count($trx['items']) > 1)
                                        <span class="text-gray-500 font-medium">+{{ count($trx['items']) - 1 }} produk lainnya</span>
                                    @endif
                                </p>
                                @if($firstItem)
                                    <p class="text-xs text-gray-500">{{ $firstItem['qty'] }} barang x Rp{{ number_format($firstItem['price'], 0, ',', '.') }}</p>
                                @endif
                                <p class="mt-2 text-xs text-gray-400">Pembayaran melalui metode virtual account.</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <a
                                href="{{ route('customer.transaction_detail', ['id' => $trx['id']]) }}"
                                class="whitespace-nowrap rounded-full border border-orange-500 px-4 py-2 text-sm font-semibold text-orange-600 hover:bg-orange-50"
                            >
                                Lihat Detail Transaksi
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-16 text-center text-gray-500">
                    Belum ada transaksi untuk filter yang dipilih.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
