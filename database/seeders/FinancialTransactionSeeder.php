<?php

namespace Database\Seeders;

use App\Models\FinancialTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinancialTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FinancialTransaction::factory()
            ->count(30)
            ->create();
    }
}
