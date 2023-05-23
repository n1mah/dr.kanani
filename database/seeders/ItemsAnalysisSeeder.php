<?php

namespace Database\Seeders;

use App\Models\Items_analysis;
use App\Models\Items_analysis as ItemsAnalysis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsAnalysisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemsAnalysis::factory()
            ->count(20)
            ->create();
    }
}
