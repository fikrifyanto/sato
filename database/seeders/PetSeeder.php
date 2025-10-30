<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        Pet::create([
            'name' => 'Kucing Persia',
            'species' => 'Cat',
            'age' => 2,
            'gender' => 'female',
            'description' => 'Kucing lucu dan jinak, cocok untuk anak-anak.',
            'status' => 'available',
            'price' => 500000,
            'breed' => 'Persia',
            'vaccinated' => true,
            'color' => 'Putih',
            'weight' => 3,
        ]);
    }
}
