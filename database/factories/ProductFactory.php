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
        $category = $this->faker->randomElement(['pet_food', 'pet_accessory']);

        return [
            'name' => $category === 'pet_food'
                ? $this->faker->randomElement([
                    'Dry Food Premium',
                    'Wet Food Salmon',
                    'Cat Tuna Meal',
                    'Dog Beef Meal',
                ])
                : $this->faker->randomElement([
                    'Pet Collar',
                    'Dog Leash',
                    'Cat Toy',
                    'Pet Bowl',
                ]),
            'description' => $this->faker->sentence(12),
            'price' => $category === 'pet_food'
                ? $this->faker->randomElement([25_000, 35_000, 50_000, 75_000])
                : $this->faker->randomElement([30_000, 50_000, 75_000, 120_000]),
            'stock' => $this->faker->numberBetween(5, 100),
            'category' => $category == 'pet_food' ? 'Makanan Hewan' : 'Aksesoris Hewan',
            'images' => [],
        ];
    }
}
