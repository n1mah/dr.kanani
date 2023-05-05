<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $p= Prescription::all()->random();
        return [
             'patient_id'=>$p->appointment->patient->national_code,
             'prescription_id'=>$p->id,
            'title' => fake()->sentence(rand(1,8)),
            'content' =>  fake()->sentence(rand(5,15)),
        ];
    }
}
