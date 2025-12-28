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
        $species = $this->faker->randomElement(['Anjing', 'Kucing']);

        return [
            'images' => [],
            'name' => $this->faker->firstName(),
            'species' => $species,
            'breed' => $species === 'Anjing'
                ? $this->faker->randomElement(['Golden Retriever', 'Bulldog', 'Poodle'])
                : $this->faker->randomElement(['Persian', 'Maine Coon', 'Siamese']),
            'age' => $this->faker->numberBetween(1, 15),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'color' => $this->faker->safeColorName(),
            'weight' => $this->faker->randomFloat(1, 1.5, 40),
            'description' => $this->faker->sentence(12),
            'status' => $this->faker->randomElement(['available', 'adopted']),
            'vaccinated' => $this->faker->boolean(),
        ];
    }
}
