<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Analysis;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            InsuranceSeeder::class,
            ReportSeeder::class,
            FinancialTransactionSeeder::class,
            AnalysisSeeder::class,
            ItemsAnalysisSeeder::class,
        ]);
    }
}
