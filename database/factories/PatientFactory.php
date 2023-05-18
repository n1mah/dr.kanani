<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'national_code' => fake()->numberBetween(1000000000,9999999999),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'day' => fake()->numberBetween(1, 30),
            'month' => fake()->numberBetween(1,12),
            'year' => fake()->numberBetween(1350,1400),
            'mobile' => "09".fake()->randomElement([12,'03',18,10,33,39,37,36]).fake()->numberBetween(1000000,9999999),
            'phone' => "0".fake()->randomElement([81,21]).fake()->numberBetween(10000000,99999999),
            'is_active' => true,
            ];
    }
}
