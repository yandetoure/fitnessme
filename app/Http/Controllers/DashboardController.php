<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\NutritionItem;
use App\Models\UserGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $userGoals = UserGoal::where('user_id', $user->id)
                            ->where('is_active', true)
                            ->with('goal')
                            ->get()
                            ->pluck('goal');
        $allGoals = Goal::where('is_active', true)->get();

        // Get nutrition items for user's goals
        $nutritionItems = collect();
        foreach ($userGoals as $goal) {
            $items = NutritionItem::where('category', $goal->category)
                                ->where('is_active', true)
                                ->get();
            $nutritionItems = $nutritionItems->merge($items);
        }

        return view('dashboard', compact('user', 'userGoals', 'allGoals', 'nutritionItems'));
    }

    /**
     * Show goal details with exercises and nutrition.
     */
    public function goalDetails($goalId)
    {
        $goal = Goal::findOrFail($goalId);
        $user = Auth::user();

        // Check if user has this goal
        $userHasGoal = UserGoal::where('user_id', $user->id)
                              ->where('goal_id', $goalId)
                              ->where('is_active', true)
                              ->exists();

        // Get nutrition items for this goal
        $nutritionItems = NutritionItem::where('category', $goal->category)
                                     ->where('is_active', true)
                                     ->get();

        return view('goal-details', compact('goal', 'userHasGoal', 'nutritionItems'));
    }
}
