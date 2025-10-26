<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'product_name' => 'Makanan Kucing Whiskas',
                'description' => 'Makanan bergizi tinggi untuk kucing dewasa dengan rasa tuna.',
                'price' => 50000,
                'stock' => 20,
                'category' => 'Makanan Hewan',
                'image' => 'images/whiskas.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Pasir Kucing Gumpal 10kg',
                'description' => 'Pasir wangi dengan daya serap tinggi, cocok untuk menjaga kebersihan kandang.',
                'price' => 80000,
                'stock' => 15,
                'category' => 'Perlengkapan Hewan',
                'image' => 'images/pasir-kucing.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Pet Carrier',
                'description' => 'Tas pembawa hewan peliharaan yang kuat dan nyaman untuk perjalanan.',
                'price' => 150000,
                'stock' => 10,
                'category' => 'Perlengkapan Hewan',
                'image' => 'images/pet-carrier.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Kalung Anjing Lucu',
                'description' => 'Aksesori nyaman dan kuat untuk anjing kecil maupun besar.',
                'price' => 25000,
                'stock' => 25,
                'category' => 'Aksesori Hewan',
                'image' => 'images/kalung-anjing.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Shampoo Kucing Anti Kutu',
                'description' => 'Membersihkan bulu sekaligus melindungi kucing dari kutu dan jamur.',
                'price' => 35000,
                'stock' => 18,
                'category' => 'Perawatan Hewan',
                'image' => 'images/shampoo-kucing.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
