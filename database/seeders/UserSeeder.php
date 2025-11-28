<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public static $targetCount = 5;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => RoleEnum::Admin->value,
            ]);
        }

        // Create User
        if (!User::where('email', 'user@gmail.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => RoleEnum::User->value,
            ]);
        }

        // Create Random Users
        $targetCount = self::$targetCount;
        $currentCount = User::count(); // This includes admin and test user
        $remaining = $targetCount - $currentCount;

        if ($remaining > 0) {
            $this->command->info("Generating remaining {$remaining} users to reach {$targetCount}...");
            User::factory()->count($remaining)->create();
        }
    }
}
