<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seed the database with our data
        $this->call([
            GoalSeeder::class,
            ExerciseTypeSeeder::class,
            NutritionItemSeeder::class,
        ]);

        // Create a test user
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'phone_number' => '123456789',
            'country_code' => '33',
        ]);
    }
}
