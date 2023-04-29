<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Insurance;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Insurance::factory()
            ->has(Patient::factory()
                ->has(
                    Appointment::factory()
                    ->count(rand(1,3))
                )
                ->count(4)
            )
            ->count(10)
            ->create();
    }
}
