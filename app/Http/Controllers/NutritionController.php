<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\NutritionItem;
use Illuminate\Http\Request;

class NutritionController extends Controller
{
    /**
     * Get all nutrition items.
     */
    public function index()
    {
        $items = NutritionItem::where('is_active', true)->get();

        return response()->json([
            'nutrition_items' => $items,
        ]);
    }

    /**
     * Get nutrition items by type.
     */
    public function byType($type)
    {
        $items = NutritionItem::where('type', $type)
                             ->where('is_active', true)
                             ->get();

        return response()->json([
            'nutrition_items' => $items,
        ]);
    }

    /**
     * Get nutrition items by category.
     */
    public function byCategory($category)
    {
        $items = NutritionItem::where('category', $category)
                             ->where('is_active', true)
                             ->get();

        return response()->json([
            'nutrition_items' => $items,
        ]);
    }

    /**
     * Get nutrition item details.
     */
    public function show($id)
    {
        $item = NutritionItem::findOrFail($id);

        return response()->json([
            'nutrition_item' => $item,
        ]);
    }

    /**
     * Get nutrition items for weight loss.
     */
    public function weightLoss()
    {
        $items = NutritionItem::where('category', 'perte_poids')
                             ->where('is_active', true)
                             ->get();

        return response()->json([
            'nutrition_items' => $items,
        ]);
    }

    /**
     * Get nutrition items for weight gain.
     */
    public function weightGain()
    {
        $items = NutritionItem::where('category', 'prise_poids')
                             ->where('is_active', true)
                             ->get();

        return response()->json([
            'nutrition_items' => $items,
        ]);
    }

    /**
     * Get tisanes.
     */
    public function tisanes()
    {
        $items = NutritionItem::where('type', 'tisane')
                             ->where('is_active', true)
                             ->get();

        return response()->json([
            'tisanes' => $items,
        ]);
    }

    /**
     * Get plats.
     */
    public function plats()
    {
        $items = NutritionItem::where('type', 'plat')
                             ->where('is_active', true)
                             ->get();

        return response()->json([
            'plats' => $items,
        ]);
    }
}
