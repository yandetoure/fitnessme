<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ExerciseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Musculation',
                'description' => 'Exercices de musculation pour développer la masse musculaire',
                'icon' => '💪',
                'is_active' => true,
            ],
            [
                'name' => 'Cardio',
                'description' => 'Exercices cardiovasculaires pour brûler les calories',
                'icon' => '🏃‍♀️',
                'is_active' => true,
            ],
            [
                'name' => 'Yoga',
                'description' => 'Exercices de yoga pour la flexibilité et la relaxation',
                'icon' => '🧘‍♀️',
                'is_active' => true,
            ],
            [
                'name' => 'Pilates',
                'description' => 'Exercices de Pilates pour le renforcement musculaire',
                'icon' => '🤸‍♀️',
                'is_active' => true,
            ],
            [
                'name' => 'Danse',
                'description' => 'Exercices de danse pour la coordination et le cardio',
                'icon' => '💃',
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            ExerciseType::create($type);
        }
    }
}
