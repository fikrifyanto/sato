<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pets = Pet::all();
        $products = Product::all();

        return view('customer.dashboard', compact('pets', 'products'));
    }

    public function products()
    {
        $products = Product::all();

        // ubah ke array siap JSON
        $productsData = $products->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $p->price,
                'category' => $p->category ?? 'Lainnya',
                'image' => !empty($p->images)
                    ? asset('storage/' . (is_array($p->images) ? $p->images[0] : $p->images))
                    : 'https://picsum.photos/300?random=' . $p->id,
                'stock' => $p->stock > 0 ? 'in' : 'out',
                'stock_qty' => $p->stock,
            ];
        });

        // ubah ke JSON
        $productsJson = $productsData->toJson();

        // kirim keduanya ke view
        return view('customer.products', compact('products', 'productsJson'));
    }

    public function showProduct($id)
    {
        $product = Product::findOrFail($id);

        // Ambil semua gambar
        $images = !empty($product->images)
            ? array_map(
                fn($img) => asset('storage/' . $img),
                is_array($product->images) ? $product->images : [$product->images]
            )
            : ['https://picsum.photos/500?random=' . $product->id];

        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'category' => $product->category ?? 'Lainnya',
            'description' => $product->description ?? '-',

            // semua gambar
            'images' => $images,

            // gambar utama
            'image_main' => $images[0],

            // stok
            'stock' => $product->stock > 0 ? 'in' : 'out',
            'stock_qty' => $product->stock,
        ];

        return view('customer.product_detail', compact('productData'));
    }

    public function pets()
    {
        $pets = Pet::all();

        // ubah ke array siap JSON
        $petsData = $pets->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'species' => $p->species ?? 'Lainnya',
                'breed' => $p->breed ?? 'Lainnya',
                'gender' => ucfirst($p->gender ?? 'Tidak Diketahui'),
                'status' => $p->status ?? 'available',
                'vaccinated' => $p->vaccinated ? 'Sudah' : 'Belum',
                'price' => $p->price ?? 0,
                'image' => !empty($p->images)
                    ? asset('storage/' . (is_array($p->images) ? $p->images[0] : $p->images))
                    : 'https://picsum.photos/300?random=' . $p->id,
                'stock' => $p->status === 'available' ? 'in' : 'out',
            ];
        });

        // buat list unik spesies & breed untuk filter, ganti null dengan 'Lainnya'
        $speciesList = $pets->pluck('species')
            ->map(fn($s) => $s ?? 'Lainnya')
            ->filter(fn($s) => !empty($s))
            ->unique()
            ->values();

        $breedList = $pets->pluck('breed')
            ->map(fn($b) => $b ?? 'Lainnya')
            ->filter(fn($b) => !empty($b))
            ->unique()
            ->values();

        $petsJson = $petsData->toJson();

        return view('customer.pets', compact('petsJson', 'speciesList', 'breedList'));
    }

    public function showPets($id)
    {
        $pet = Pet::findOrFail($id);

        $images = !empty($pet->images)
            ? array_map(
                fn($img) => asset('storage/' . $img),
                is_array($pet->images) ? $pet->images : [$pet->images]
            )
            : ['https://picsum.photos/500?random=' . $pet->id];

        $petData = [
            'id' => $pet->id,
            'name' => $pet->name,
            'species' => $pet->species ?? 'Lainnya',
            'breed' => $pet->breed ?? 'Lainnya',
            'gender' => ucfirst($pet->gender ?? 'Tidak Diketahui'),
            'status' => $pet->status ?? 'available',
            'vaccinated' => $pet->vaccinated ? 'Sudah' : 'Belum',
            'price' => $pet->price ?? 0,
            'description' => $pet->description ?? '-',
            'images' => $images,
            'image_main' => $images[0] ?? null,
            'stock' => $pet->status === 'available' ? 'in' : 'out',
        ];

        return view('customer.pet_detail', compact('petData'));
    }

    public function carts()
    {
        // Dummy data cart (bisa diganti nanti kalau sudah ada tabel cart)
        $cartItems = [
            [
                'id' => 1,
                'name' => 'Royal Canin Indoor Cat Food 2KG',
                'category' => 'Makanan Kucing',
                'price' => 220000,
                'qty' => 1,
                'image' => 'https://picsum.photos/120?random=1',
            ],
            [
                'id' => 2,
                'name' => 'Kalung Kucing Anti Hilang GPS Tracker',
                'category' => 'Aksesoris Kucing',
                'price' => 150000,
                'qty' => 2,
                'image' => 'https://picsum.photos/120?random=2',
            ],
            [
                'id' => 3,
                'name' => 'Pasir Kucing Wangi Lavender 10L',
                'category' => 'Perlengkapan',
                'price' => 75000,
                'qty' => 1,
                'image' => 'https://picsum.photos/120?random=3',
            ],
        ];

        // Hitung total harga item
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }

        // Dummy shipping cost
        $shippingCost = 30000;

        // Total pembayaran
        $total = $subtotal + $shippingCost;

        // Kirim data ke view
        return view('customer.carts', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    public function transactions(Request $request)
    {
        // Dummy Data
        $transactions = [
            [
                'id' => 'TRX001',
                'date' => '2025-01-15',
                'status' => 'completed',
                'total' => 350000,
                'items' => [
                    ['name' => 'Premium Cat Food', 'qty' => 2, 'price' => 150000],
                    ['name' => 'Mainan Kucing', 'qty' => 1, 'price' => 50000],
                ]
            ],
            [
                'id' => 'TRX002',
                'date' => '2025-01-10',
                'status' => 'pending',
                'total' => 125000,
                'items' => [
                    ['name' => 'Shampoo Anjing', 'qty' => 1, 'price' => 125000],
                ]
            ],
            [
                'id' => 'TRX003',
                'date' => '2024-12-29',
                'status' => 'cancelled',
                'total' => 90000,
                'items' => [
                    ['name' => 'Vitamin Kucing', 'qty' => 1, 'price' => 90000],
                ]
            ],
        ];

        $statusFilters = [
            'all' => 'Semua',
            'pending' => 'Berlangsung',
            'completed' => 'Berhasil',
            'cancelled' => 'Tidak Berhasil',
        ];

        $selectedStatus = $request->query('status', 'all');
        if (!array_key_exists($selectedStatus, $statusFilters)) {
            $selectedStatus = 'all';
        }

        $filteredTransactions = $selectedStatus === 'all'
            ? $transactions
            : array_values(array_filter(
                $transactions,
                fn($trx) => $trx['status'] === $selectedStatus
            ));

        return view('customer.transactions', [
            'transactions' => $filteredTransactions,
            'statusFilters' => $statusFilters,
            'selectedStatus' => $selectedStatus,
        ]);
    }

    public function transactionDetail($id)
    {
        // Dummy detail data
        $transaction = [
            'id'           => $id,
            'order_code'   => 'TRX20250101',
            'status'       => 'Selesai',
            'date'         => '2025-11-21 14:32',
            'subtotal'     => 570000,
            'ongkir'       => 20000,
            'diskon'       => 10000,
            'total'        => 580000,
            'customer'     => [
                'name'    => 'Andre Prasetyo',
                'phone'   => '081234567890',
                'address' => 'Jl. Merdeka No. 11, Bandung, Jawa Barat',
                'zipcode' => '40111'
            ],
            'products'     => [
                [
                    'name'  => 'Dog Food Premium 2KG',
                    'variasi' => 'Original',
                    'qty'   => 1,
                    'price' => 120000,
                    'image' => 'https://picsum.photos/200?random=1',
                ],
                [
                    'name'  => 'Kandang Stainless Medium',
                    'variasi' => 'Silver',
                    'qty'   => 1,
                    'price' => 450000,
                    'image' => 'https://picsum.photos/200?random=2',
                ],
            ]
        ];

        return view('customer.transaction_detail', compact('transaction'));
    }
}
