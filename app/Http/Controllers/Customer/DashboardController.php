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

        $image = !empty($product->images)
            ? (is_array($product->images) ? asset('storage/' . $product->images[0]) : asset('storage/' . $product->images))
            : 'https://picsum.photos/500?random=' . $product->id;

        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'category' => $product->category ?? 'Lainnya',
            'description' => $product->description ?? '-',
            'image' => $image,
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

        $image = !empty($pet->images)
            ? (is_array($pet->images) ? asset('storage/' . $pet->images[0]) : asset('storage/' . $pet->images))
            : 'https://picsum.photos/500?random=' . $pet->id;

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
            'image' => $image,
            'stock' => $pet->status === 'available' ? 'in' : 'out',
        ];

        return view('customer.pet_detail', compact('petData'));
    }
}
