<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = fake()->randomElement(['pet_food', 'pet_accessory']);

        return [
            'name' => $category === 'pet_food'
                ? fake()->randomElement([
                    'Dry Food Premium',
                    'Wet Food Salmon',
                    'Cat Tuna Meal',
                    'Dog Beef Meal',
                ])
                : fake()->randomElement([
                    'Pet Collar',
                    'Dog Leash',
                    'Cat Toy',
                    'Pet Bowl',
                ]),
            'description' => fake()->sentence(12),
            'price' => $category === 'pet_food'
                ? fake()->randomElement([25_000, 35_000, 50_000, 75_000])
                : fake()->randomElement([30_000, 50_000, 75_000, 120_000]),
            'stock' => fake()->numberBetween(5, 100),
            'category' => $category == 'pet_food' ? 'Makanan Hewan' : 'Aksesoris Hewan',
            'images' => [],
        ];
    }
}
