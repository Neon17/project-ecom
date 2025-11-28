<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Configure for Large Seeding
        ProductSeeder::$targetCount = 10000;
        UserSeeder::$targetCount = 1000;
        OrderSeeder::$targetCount = 5000;

        $this->call(DatabaseSeeder::class);
    }
}
