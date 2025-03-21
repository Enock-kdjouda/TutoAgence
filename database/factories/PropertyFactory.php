<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rooms = $this->faker->numberBetween(1, 10); 

        return [
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(4, true),
            'surface' => $this->faker->numberBetween(20, 400),
            'rooms' => $rooms,
            'bedrooms' => $this->faker->numberBetween(1, $rooms),
            'floor' => $this->faker->numberBetween(0, 5),
            'price' => $this->faker->randomFloat(2, 100000, 1000000000),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'postal_code' => $this->faker->postcode(),
            'sold' => false
        ];
    }
    public function sold(): static {
        return $this->state(function (array $attributes) {
            return [
                'sold' => true
            ];
        });
    }
}
