<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialTransaction>
 */
class FinancialTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $appointment= Appointment::all()->random();

        $methods = ["کارت به کارت", "نقدی", "دستگاه pos" , "چندحالتی", "غیره"];
//        $fees = [1800000, 1200000, 1000000, 1650000];
        return [
            'patient_id'=>$appointment->patient->national_code,
            'title' => fake()->word(),
            'method' => fake()->randomElement($methods),
            'payment_amount' => $appointment->patient->insurance->fee,
            'comment' =>fake()->sentence(),
        ];
    }
}
