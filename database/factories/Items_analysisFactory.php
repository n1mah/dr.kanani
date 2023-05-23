<?php

namespace Database\Factories;

use App\Models\Analysis;
use App\Models\Items_analysis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Items_analysis>
 */
class Items_analysisFactory extends Factory
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
            'analysis_id' => Analysis::all()->random()->id,
            'value' => fake()->word(),
//            'datetime' => $time*1000,
            'datetime' => date("Y-m-d H:i:s"),
        ];
    }
}
