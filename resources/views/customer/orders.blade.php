@php use App\Enums\OrderStatus; @endphp
@extends('customer.layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 pb-12">
        <h1 class="text-2xl font-semibold text-gray-900 mb-5">Riwayat Transaksi</h1>

        @php
            $statusMeta = [
                    OrderStatus::Completed->value => [
                        'label' => 'Berhasil',
                        'badge' => 'bg-emerald-100 text-emerald-700',
                        'dot' => 'bg-emerald-500',
                    ],
                    OrderStatus::Pending->value => [
                        'label' => 'Menunggu Pembayaran',
                        'badge' => 'bg-slate-100 text-slate-600',
                        'dot' => 'bg-slate-400',
                    ],
                    OrderStatus::Processing->value => [
                        'label' => 'Proses',
                        'badge' => 'bg-orange-100 text-orange-600',
                        'dot' => 'bg-orange-500',
                    ],
                    OrderStatus::Cancelled->value => [
                        'label' => 'Dibatalkan',
                        'badge' => 'bg-rose-100 text-rose-700',
                        'dot' => 'bg-rose-500',
                    ],
                ];
        @endphp

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <form method="GET" action="{{ route('orders.index') }}" class="px-6 py-6 space-y-5">
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
                            href="{{ route('orders.index') }}"
                            class="ml-auto text-sm font-medium text-orange-500 hover:text-orange-600"
                        >
                            Reset Filter
                        </a>
                    @endif
                </div>
            </form>

            <div class="border-t border-gray-100">
                @forelse($orders as $order)
                    @php
                        $meta = $statusMeta[$order->status->value] ?? [
                            'label' => ucfirst($order->status->value),
                            'badge' => 'bg-gray-100 text-gray-600',
                            'dot' => 'bg-gray-400',
                        ];
                        $firstItem = $order->orderItems->first() ?? null;
                    @endphp

                    <div class="px-6 py-6 border-b last:border-b-0 border-gray-100">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:gap-6">
                                <div class="flex items-center gap-3 text-xs text-gray-500">
                                <span
                                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold {{ $meta['badge'] }}">
                                    <span class="h-2 w-2 rounded-full {{ $meta['dot'] }}"></span>
                                    {{ $meta['label'] }}
                                </span>
                                    <span class="text-gray-300">•</span>
                                    <span>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y') }}</span>
                                    <span class="text-gray-300">•</span>
                                    <span>{{ $order->code }}</span>
                                </div>
                            </div>

                            <div class="flex flex-col items-start gap-2 sm:flex-row sm:items-center sm:gap-4">
                                <div class="text-right sm:text-left">
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">Total Belanja</p>
                                    <p class="text-base font-semibold text-gray-900">
                                        Rp {{ number_format($order->amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            <div class="flex items-start gap-4">
                                <div
                                    class="hidden h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl bg-gray-100 md:flex items-center justify-center">
                                    <img class="size-18 aspect-square object-cover" src="{{ asset('storage/' . $firstItem->item->images[0]) }}" alt="{{ $firstItem->item->name }}"/>
                                    <svg class="h-8 w-8 text-gray-300" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="1.25">
                                        <path d="M4 7h16M4 12h16M4 17h10" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $firstItem->item->name ?? 'Produk tidak tersedia' }}
                                        @if($firstItem && count($order->orderItems) > 1)
                                            <span class="text-gray-500 font-medium">+{{ count($order->orderItems) - 1 }} produk lainnya</span>
                                        @endif
                                    </p>
                                    @if($firstItem)
                                        <p class="text-xs text-gray-500 mt-3">{{ $firstItem->quantity }} x
                                            Rp {{ number_format($firstItem->subtotal, 0, ',', '.') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <a
                                    href="{{ route('orders.show', $order->id) }}"
                                    class="whitespace-nowrap rounded-md border border-orange-500 px-4 py-2 text-sm font-semibold text-orange-600 hover:bg-orange-50"
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
