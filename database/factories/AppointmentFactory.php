<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $time=fake()->numberBetween(1682777781,1704067199);
        return [
//            'patient_id' => Patient::all()->random()->id,
            'type' => fake()->word(),
            'visit_time' => $time*1000,
            'status' => 1,
//            'change_status' => $time+(60*60*2),
            'descriptions' => fake()->sentence(),
            ];
    }
}
