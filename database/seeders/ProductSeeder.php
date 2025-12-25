<?php

namespace Database\Seeders;


use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()
            ->count(20)
            ->state(new Sequence(
                fn($sequence) => [
                    'price' => 25_000 + ($sequence->index * 10_000),
                ]
            ))
            ->create()
            ->each(function (Product $product) {

                $category = $product->category == 'Makanan Hewan' ? 'pet_food' : 'pet_accessory';
                $sourcePath = database_path("seeders/images/products/{$category}");

                if (!is_dir($sourcePath)) return;

                $files = collect(scandir($sourcePath))
                    ->reject(fn($f) => in_array($f, ['.', '..']));

                if ($files->isEmpty()) return;

                $images = [];
                $selectedFiles = $files->random(min(2, $files->count()));

                foreach ($selectedFiles as $file) {
                    $fileName = uniqid() . '-' . $file;
                    $storagePath = "products/{$category}/{$fileName}";

                    Storage::disk('public')->put(
                        $storagePath,
                        file_get_contents($sourcePath . '/' . $file)
                    );

                    $images[] = $storagePath;
                }

                $product->update(['images' => $images]);
            });
    }
}
