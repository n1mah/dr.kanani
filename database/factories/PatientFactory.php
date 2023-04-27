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
            'birthday' => fake()->dateTimeBetween('-20 days', now()),
            'mobile' => fake()->phoneNumber(),
            'phone' => fake()->phoneNumber(),
            ];
    }
}
