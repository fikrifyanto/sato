<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        Pet::factory()
            ->count(20)
            ->state(new Sequence(
                fn ($sequence) => [
                    'price' => 500_000 + ($sequence->index * 500_000),
                ]
            ))
            ->create()
            ->each(function (Pet $pet) {
                $species = $pet->species == 'Anjing' ? 'dog' : 'cat' ; // cat | dog

                $sourcePath = database_path("seeders/images/pets/{$species}s");

                if (! is_dir($sourcePath)) {
                    return;
                }

                $files = collect(scandir($sourcePath))
                    ->reject(fn ($f) => in_array($f, ['.', '..']));

                if ($files->isEmpty()) {
                    return;
                }

                $images = [];
                $selectedFiles = $files->random(min(2, $files->count()));

                foreach ($selectedFiles as $file) {
                    $fileName = uniqid() . '-' . $file;
                    $storagePath = "pets/{$species}s/{$fileName}";

                    Storage::disk('public')->put(
                        $storagePath,
                        file_get_contents($sourcePath . '/' . $file)
                    );

                    $images[] = $storagePath;
                }

                $pet->update([
                    'images' => $images,
                ]);
            });;
    }
}
