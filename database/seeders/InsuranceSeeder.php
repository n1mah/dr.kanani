<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Insurance;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Report;
use Database\Factories\PatientFactory;
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
                        ->has(
                            Prescription::factory()
                                ->count(1)
                        )
                        ->count(2)
                )
                ->count(3)
            )
            ->count(10)
            ->create();


    }


}
