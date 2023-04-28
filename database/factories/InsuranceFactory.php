<?php

namespace Database\Factories;

use App\Models\Insurance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insurance>
 */
class InsuranceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fees = [1800000, 1200000, 1000000, 1650000];
        return [
            'title' => fake()->jobTitle(),
            'fee' => fake()->randomElement($fees)
        ];
    }
}
