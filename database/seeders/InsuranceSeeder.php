<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Insurance;
use App\Models\Patient;
use App\Models\Prescription;
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
                        ->hasPrescriptions(2)
                        ->count(2)
                )
                ->count(3)
            )
            ->count(10)
            ->create();
    }
}
