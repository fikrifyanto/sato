@php use App\Enums\OrderStatus; @endphp
@extends('customer.layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 pb-12">
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

            $meta = $statusMeta[$order->status->value] ?? $statusMeta['pending'];
        @endphp

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Detail Transaksi</h1>
                <p class="text-sm text-gray-500 mt-1">Tinjau ringkasan dan rincian pesanan Anda.</p>
            </div>
            <a
                href="{{ route('orders.index') }}"
                class="hidden md:inline-flex items-center gap-2 rounded-md border border-orange-200 px-4 py-2 text-sm font-semibold text-orange-600 hover:bg-orange-50"
            >
                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="m11.5 6-4 4 4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-6 border-b border-gray-100">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold {{ $meta['badge'] }}">
                            <span class="h-2 w-2 rounded-full {{ $meta['dot'] }}"></span>
                            {{ $meta['label'] }}
                        </span>
                            <span class="text-gray-300">•</span>
                            <span>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y, H:i') }}</span>
                            <span class="text-gray-300">•</span>
                            <span class="font-medium text-gray-700">{{ $order->code }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col items-start gap-2 sm:flex-row sm:items-center sm:gap-4">
                        <div class="text-left sm:text-right">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Total Belanja</p>
                            <p class="text-xl font-semibold text-gray-900">
                                Rp {{ number_format($order->amount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 px-6 py-6 lg:grid-cols-[minmax(0,1fr)_320px]">
                <div class="space-y-6">
                    <section>
                        <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-3">Ringkasan
                            Produk</h2>
                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                                <article
                                    class="flex items-start gap-4 rounded-2xl border border-gray-100 bg-gray-50/80 px-4 py-4">
                                    <div
                                        class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl border border-gray-100">
                                        <img
                                            src="{{ isset($item->item?->images[0]) ? asset('storage/' . $item->item->images[0]) : ''}}"
                                            alt="{{ $item->item?->name }}"
                                            class="h-full w-full object-cover">
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <p class="text-sm font-semibold text-gray-900">{{ $item->item?->name }}</p>
                                        <p class="text-xs text-gray-500">Jumlah: {{ $item->quantity }}</p>
                                        <p class="text-xs text-gray-500">
                                            Harga: Rp {{ number_format($item->item?->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-gray-900">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>

                    <section class="rounded-2xl border border-gray-100 bg-white px-4 py-4">
                        <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-4">Detail
                            Pembayaran</h2>
                        <hr class="my-4 border-gray-200">
                        <div class="flex justify-between items-center text-base font-semibold text-gray-900">
                            <span>Total</span>
                            <span
                                class="text-orange-600">Rp {{ number_format($order->amount, 0, ',', '.') }}</span>
                        </div>
                    </section>
                </div>

                <aside class="rounded-2xl border border-gray-100 bg-white px-5 py-5 space-y-4">
                    <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Informasi Pengiriman</h2>
                    <div class="space-y-3 text-sm text-gray-600">
                        <p>
                            <span class="text-gray-500 block text-xs uppercase tracking-wide">Penerima</span>
                            <span class="font-semibold text-gray-900">{{ $order->customer_name ?? '-' }}</span>
                        </p>
                        <p>
                            <span class="text-gray-500 block text-xs uppercase tracking-wide">Nomor Telepon</span>
                            <span class="font-semibold text-gray-900">{{ $order->customer_phone ?? '-' }}</span>
                        </p>
                        <p>
                            <span class="text-gray-500 block text-xs uppercase tracking-wide">Email</span>
                            <span class="font-semibold text-gray-900">{{ $order->customer_email ?? '-' }}</span>
                        </p>
                        <p>
                            <span class="text-gray-500 block text-xs uppercase tracking-wide">Alamat Lengkap</span>
                            <span
                                class="font-medium text-gray-900 leading-relaxed">{{ $order->address_detail }}<br>Kode Pos {{ $order->address_postcode }}</span>
                        </p>
                    </div>
                    <div class="rounded-2xl bg-gray-50 px-4 py-3 text-xs text-gray-500">
                        Pesanan ini dikirim menggunakan layanan kurir reguler. Estimasi tiba 1-3 hari kerja.
                    </div>
                </aside>
            </div>
            <div class="flex justify-end gap-2 p-4">
                <button onclick="pay()"
                        class="flex justify-center rounded-md bg-red-500 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-red-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">
                    Batalkan
                </button>

                <button onclick="pay()"
                        class="flex justify-center rounded-md bg-primary px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                    Bayar
                </button>
            </div>
        </div>

        <div class="mt-8 flex flex-col items-center gap-3 md:hidden">
            <a
                href="{{ route('orders.index') }}"
                class="inline-flex items-center gap-2 rounded-full border border-orange-200 px-4 py-2 text-sm font-semibold text-orange-600 hover:bg-orange-50"
            >
                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="m11.5 6-4 4 4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                Kembali ke daftar
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        @if($order->status == OrderStatus::Pending)
        function pay() {
            snap.pay('{{$order->lastOrderPayment->token}}')
        }

        document.addEventListener('DOMContentLoaded', function () {
            pay()
        });
        @endif
    </script>
@endsection
