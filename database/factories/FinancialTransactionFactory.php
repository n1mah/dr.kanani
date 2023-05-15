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
        $methods = [ "دستگاه کارتخوان" , "کارت به کارت", "نقدی" , "چندحالتی" , "غیره"];
        $changeable = [true,false];
        $time=fake()->numberBetween(1682777781,1704067199);
        return [
            'patient_id'=>$appointment->patient->national_code,
            'appointment_id'=>fake()->randomElement([$appointment->id,null]),
            'title' => fake()->word(),
            'method' => fake()->randomElement($methods),
            'payment_amount' => $appointment->patient->insurance->fee,
            'comment' =>fake()->sentence(),
            'pay_time' => $time*1000,
            'changeable' => fake()->randomElement($changeable),
            'is_active'=>true
        ];
    }
}
