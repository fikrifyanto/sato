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
            ];
        });

        // ubah ke JSON
        $productsJson = $productsData->toJson();

        // kirim keduanya ke view
        return view('customer.products', compact('products', 'productsJson'));
    }

    public function pets()
    {
        $pets = Pet::all();

        // ubah ke array siap JSON
        $petsData = $pets->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $p->price,
                'category' => $p->category ?? 'Lainnya',
                'image' => !empty($p->images)
                    ? asset('storage/' . (is_array($p->images) ? $p->images[0] : $p->images))
                    : 'https://picsum.photos/300?random=' . $p->id,
                'stock' => $p->stock > 0 ? 'in' : 'out',
            ];
        });

        // ubah ke JSON
        $petsJson = $petsData->toJson();

        // kirim keduanya ke view
        return view('customer.pets', compact('pets', 'petsJson'));
    }
}
