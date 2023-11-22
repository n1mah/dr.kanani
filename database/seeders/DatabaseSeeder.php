<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Analysis;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                "id"=>1,
                "name"=>'mr HamidReza',
                'email' => 'hamidrezabstn@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'), // password
            ],
        ]);
        $this->call([
            InsuranceSeeder::class,
            ReportSeeder::class,
            FinancialTransactionSeeder::class,
            AnalysisSeeder::class,
            ItemsAnalysisSeeder::class,
        ]);
    }
}
