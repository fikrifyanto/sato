<?php

namespace Database\Factories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = fake()->randomElement(['Anjing', 'Kucing']);

        return [
            'images' => [],
            'name' => fake()->firstName(),
            'species' => $species,
            'breed' => $species === 'Anjing'
                ? fake()->randomElement(['Golden Retriever', 'Bulldog', 'Poodle'])
                : fake()->randomElement(['Persian', 'Maine Coon', 'Siamese']),
            'age' => fake()->numberBetween(1, 15),
            'gender' => fake()->randomElement(['male', 'female']),
            'color' => fake()->safeColorName(),
            'weight' => fake()->randomFloat(1, 1.5, 40),
            'description' => fake()->sentence(12),
            'status' => fake()->randomElement(['available', 'adopted']),
            'vaccinated' => fake()->boolean(),
        ];
    }
}
