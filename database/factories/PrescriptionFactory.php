<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ["ویزیت","بررسی آزمایش یا تست"];
        return [
            // 'appointment_id'
            'reason' => fake()->sentence(rand(1,6)),
            'type' => fake()->randomElement($types),
            'text_prescription' => fake()->sentence(rand(1,15)),
        ];
    }
}
