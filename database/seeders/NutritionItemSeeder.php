<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\NutritionItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NutritionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // Tisanes pour maigrir
            [
                'name' => 'Tisane au citron et gingembre',
                'description' => 'Tisane détoxifiante pour favoriser la perte de poids',
                'ingredients' => 'Citron, gingembre, miel, eau chaude',
                'instructions' => 'Faire bouillir de l\'eau, ajouter le gingembre et le citron, laisser infuser 5 minutes',
                'type' => 'tisane',
                'category' => 'perte_poids',
                'calories' => 10,
                'preparation_time_minutes' => 10,
                'difficulty' => 'easy',
                'is_active' => true,
            ],
            [
                'name' => 'Tisane au thé vert',
                'description' => 'Tisane riche en antioxydants pour stimuler le métabolisme',
                'ingredients' => 'Thé vert, citron, miel',
                'instructions' => 'Infuser le thé vert dans l\'eau chaude, ajouter le citron et le miel',
                'type' => 'tisane',
                'category' => 'perte_poids',
                'calories' => 15,
                'preparation_time_minutes' => 5,
                'difficulty' => 'easy',
                'is_active' => true,
            ],
            // Plats pour maigrir
            [
                'name' => 'Salade de quinoa aux légumes',
                'description' => 'Salade riche en protéines et fibres pour la perte de poids',
                'ingredients' => 'Quinoa, tomates, concombre, avocat, huile d\'olive, citron',
                'instructions' => 'Cuire le quinoa, couper les légumes, mélanger avec l\'huile et le citron',
                'type' => 'plat',
                'category' => 'perte_poids',
                'calories' => 250,
                'preparation_time_minutes' => 20,
                'difficulty' => 'medium',
                'is_active' => true,
            ],
            [
                'name' => 'Smoothie protéiné',
                'description' => 'Smoothie riche en protéines pour la récupération musculaire',
                'ingredients' => 'Banane, protéines en poudre, lait d\'amande, miel',
                'instructions' => 'Mixer tous les ingrédients jusqu\'à obtenir une texture lisse',
                'type' => 'plat',
                'category' => 'prise_poids',
                'calories' => 300,
                'preparation_time_minutes' => 5,
                'difficulty' => 'easy',
                'is_active' => true,
            ],
            // Tisanes pour grossir
            [
                'name' => 'Tisane à la cannelle et miel',
                'description' => 'Tisane pour stimuler l\'appétit et favoriser la prise de poids',
                'ingredients' => 'Cannelle, miel, eau chaude',
                'instructions' => 'Faire bouillir de l\'eau, ajouter la cannelle et le miel, laisser infuser 3 minutes',
                'type' => 'tisane',
                'category' => 'prise_poids',
                'calories' => 50,
                'preparation_time_minutes' => 8,
                'difficulty' => 'easy',
                'is_active' => true,
            ],
            // Plats pour grossir
            [
                'name' => 'Bowl de fruits et granola',
                'description' => 'Bowl énergétique pour la prise de poids saine',
                'ingredients' => 'Granola, banane, fraises, yaourt grec, miel',
                'instructions' => 'Alterner les couches de granola, fruits et yaourt, arroser de miel',
                'type' => 'plat',
                'category' => 'prise_poids',
                'calories' => 400,
                'preparation_time_minutes' => 10,
                'difficulty' => 'easy',
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            NutritionItem::create($item);
        }
    }
}
