@extends('customer.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-8">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Transaksi</h2>

    @foreach($transactions as $trx)
        <div class="bg-white p-5 rounded-xl shadow mb-5 border">

            {{-- Header Transaksi --}}
            <div class="flex justify-between items-center mb-4">
                <div>
                    <p class="text-sm text-gray-500">ID Transaksi</p>
                    <p class="font-semibold">{{ $trx['id'] }}</p>
                </div>

                {{-- Status --}}
                @php
                    $color = [
                        'completed' => 'bg-green-100 text-green-700',
                        'pending' => 'bg-amber-100 text-amber-700',
                        'cancelled' => 'bg-red-100 text-red-700',
                    ][$trx['status']];
                @endphp

                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $color }}">
                    {{ ucfirst($trx['status']) }}
                </span>
            </div>

            {{-- Items --}}
            <div class="divide-y">
                @foreach($trx['items'] as $item)
                    <div class="py-3 flex justify-between">
                        <div>
                            <p class="font-medium text-gray-800">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item['qty'] }}</p>
                        </div>

                        <p class="font-semibold">
                            Rp{{ number_format($item['price'], 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between items-center border-t pt-4 mt-4">
                <p class="text-gray-600">Total Pembayaran</p>
                <p class="text-xl font-bold text-indigo-600">
                    Rp{{ number_format($trx['total'], 0, ',', '.') }}
                </p>
            </div>

            <div class="text-right mt-4">
                <a href="{{ route('customer.transaction_detail', ['id' => $trx['id']]) }}"
                   class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                    Lihat Detail →
                </a>
            </div>

        </div>
    @endforeach

</div>
@endsection
