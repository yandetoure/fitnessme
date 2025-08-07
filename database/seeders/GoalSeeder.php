<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Goal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $goals = [
            [
                'name' => 'Grossir les fesses',
                'description' => 'Exercices pour développer et tonifier les muscles fessiers',
                'category' => 'musculation',
                'icon' => '🍑',
                'is_active' => true,
            ],
            [
                'name' => 'Maigrir',
                'description' => 'Programme de perte de poids avec exercices cardio et nutrition',
                'category' => 'perte_poids',
                'icon' => '⚖️',
                'is_active' => true,
            ],
            [
                'name' => 'Tonifier les seins',
                'description' => 'Exercices pour raffermir et tonifier les muscles pectoraux',
                'category' => 'tonification',
                'icon' => '💪',
                'is_active' => true,
            ],
            [
                'name' => 'Grossir les hanches',
                'description' => 'Exercices pour développer les muscles des hanches',
                'category' => 'musculation',
                'icon' => '🦵',
                'is_active' => true,
            ],
            [
                'name' => 'Perdre du ventre',
                'description' => 'Exercices ciblés pour perdre la graisse abdominale',
                'category' => 'perte_poids',
                'icon' => '🏃‍♀️',
                'is_active' => true,
            ],
            [
                'name' => 'Tonifier les bras',
                'description' => 'Exercices pour muscler et tonifier les bras',
                'category' => 'tonification',
                'icon' => '💪',
                'is_active' => true,
            ],
        ];

        foreach ($goals as $goal) {
            Goal::create($goal);
        }
    }
}
