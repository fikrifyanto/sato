@extends('customer.layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 pb-12">
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

        $transaction = [
            'id' => 'TRX20250101',
            'status' => 'completed',
            'date' => '2025-11-21 14:32:00',
            'items' => [
                [
                    'name' => 'Dog Food Premium 2KG',
                    'variant' => 'Variasi: Original',
                    'qty' => 1,
                    'price' => 120000,
                    'image' => 'https://picsum.photos/120',
                ],
                [
                    'name' => 'Kandang Stainless Medium',
                    'variant' => 'Variasi: Silver',
                    'qty' => 1,
                    'price' => 450000,
                    'image' => 'https://picsum.photos/121',
                ],
            ],
            'payment' => [
                'subtotal' => 570000,
                'shipping' => 20000,
                'discount' => 10000,
                'total' => 580000,
            ],
            'shipping' => [
                'name' => 'Andre Prasetyo',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 11, Bandung, Jawa Barat',
                'postcode' => '40111',
            ],
        ];

        $meta = $statusMeta[$transaction['status']] ?? $statusMeta['pending'];
    @endphp

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Detail Transaksi</h1>
            <p class="text-sm text-gray-500 mt-1">Tinjau ringkasan dan rincian pesanan Anda.</p>
        </div>
        <a
            href="{{ route('customer.transactions') }}"
            class="hidden md:inline-flex items-center gap-2 rounded-full border border-orange-200 px-4 py-2 text-sm font-semibold text-orange-600 hover:bg-orange-50"
        >
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="m11.5 6-4 4 4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="px-6 py-6 border-b border-gray-100">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-3 text-sm text-gray-500">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold {{ $meta['badge'] }}">
                            <span class="h-2 w-2 rounded-full {{ $meta['dot'] }}"></span>
                            {{ $meta['label'] }}
                        </span>
                        <span class="text-gray-300">•</span>
                        <span>{{ \Carbon\Carbon::parse($transaction['date'])->translatedFormat('d M Y, H:i') }}</span>
                        <span class="text-gray-300">•</span>
                        <span class="font-medium text-gray-700">{{ $transaction['id'] }}</span>
                    </div>
                </div>

                <div class="flex flex-col items-start gap-2 sm:flex-row sm:items-center sm:gap-4">
                    <div class="text-left sm:text-right">
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Total Belanja</p>
                        <p class="text-xl font-semibold text-gray-900">Rp{{ number_format($transaction['payment']['total'], 0, ',', '.') }}</p>
                    </div>
                    <a
                        href="{{ route('customer.products') }}"
                        class="whitespace-nowrap rounded-full border border-orange-200 px-4 py-2 text-sm font-semibold text-orange-600 hover:bg-orange-50"
                    >
                        Beli Lagi
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-6 px-6 py-6 lg:grid-cols-[minmax(0,1fr)_320px]">
            <div class="space-y-6">
                <section>
                    <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-3">Ringkasan Produk</h2>
                    <div class="space-y-4">
                        @foreach($transaction['items'] as $item)
                            <article class="flex items-start gap-4 rounded-2xl border border-gray-100 bg-gray-50/80 px-4 py-4">
                                <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl border border-gray-100">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                </div>
                                <div class="flex-1 space-y-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $item['variant'] }}</p>
                                    <p class="text-xs text-gray-500">Jumlah: {{ $item['qty'] }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-gray-900">Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-400">Termasuk PPN 11%</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-2xl border border-gray-100 bg-white px-4 py-4">
                    <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-4">Detail Pembayaran</h2>
                    <dl class="space-y-2 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <dt>Subtotal</dt>
                            <dd>Rp{{ number_format($transaction['payment']['subtotal'], 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Ongkir</dt>
                            <dd>Rp{{ number_format($transaction['payment']['shipping'], 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Diskon</dt>
                            <dd>- Rp{{ number_format($transaction['payment']['discount'], 0, ',', '.') }}</dd>
                        </div>
                    </dl>
                    <hr class="my-4">
                    <div class="flex justify-between items-center text-base font-semibold text-gray-900">
                        <span>Total Akhir</span>
                        <span class="text-orange-600">Rp{{ number_format($transaction['payment']['total'], 0, ',', '.') }}</span>
                    </div>
                </section>
            </div>

            <aside class="rounded-2xl border border-gray-100 bg-white px-5 py-5 space-y-4">
                <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Informasi Pengiriman</h2>
                <div class="space-y-3 text-sm text-gray-600">
                    <p>
                        <span class="text-gray-500 block text-xs uppercase tracking-wide">Penerima</span>
                        <span class="font-semibold text-gray-900">{{ $transaction['shipping']['name'] }}</span>
                    </p>
                    <p>
                        <span class="text-gray-500 block text-xs uppercase tracking-wide">Nomor Telepon</span>
                        <span class="font-semibold text-gray-900">{{ $transaction['shipping']['phone'] }}</span>
                    </p>
                    <p>
                        <span class="text-gray-500 block text-xs uppercase tracking-wide">Alamat Lengkap</span>
                        <span class="font-medium text-gray-900 leading-relaxed">{{ $transaction['shipping']['address'] }}<br>Kode Pos {{ $transaction['shipping']['postcode'] }}</span>
                    </p>
                </div>
                <div class="rounded-2xl bg-gray-50 px-4 py-3 text-xs text-gray-500">
                    Pesanan ini dikirim menggunakan layanan kurir reguler. Estimasi tiba 1-3 hari kerja.
                </div>
            </aside>
        </div>
    </div>

    <div class="mt-8 flex flex-col items-center gap-3 md:hidden">
        <a
            href="{{ route('customer.transactions') }}"
            class="inline-flex items-center gap-2 rounded-full border border-orange-200 px-4 py-2 text-sm font-semibold text-orange-600 hover:bg-orange-50"
        >
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="m11.5 6-4 4 4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Kembali ke daftar
        </a>
    </div>
</div>
@endsection
