<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\User;
use App\Models\UserGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * Get all available goals.
     */
    public function index()
    {
        $goals = Goal::where('is_active', true)->get();

        return response()->json([
            'goals' => $goals,
        ]);
    }

    /**
     * Get user's selected goals.
     */
    public function userGoals()
    {
        $user = Auth::user();
        $userGoals = UserGoal::where('user_id', $user->id)
                            ->where('is_active', true)
                            ->with('goal')
                            ->get()
                            ->pluck('goal');

        return response()->json([
            'user_goals' => $userGoals,
        ]);
    }

    /**
     * Select a goal for the user.
     */
    public function selectGoal(Request $request)
    {
        $request->validate([
            'goal_id' => 'required|exists:goals,id',
        ]);

        $user = Auth::user();
        $goal = Goal::findOrFail($request->goal_id);

        // Check if user already has this goal
        $existingGoal = UserGoal::where('user_id', $user->id)
                               ->where('goal_id', $request->goal_id)
                               ->first();

        if ($existingGoal) {
            // Update existing goal
            $existingGoal->update([
                'is_active' => true,
                'started_at' => now(),
            ]);
        } else {
            // Create new user goal
            UserGoal::create([
                'user_id' => $user->id,
                'goal_id' => $request->goal_id,
                'is_active' => true,
                'started_at' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Goal selected successfully',
            'goal' => $goal,
        ]);
    }

    /**
     * Remove a goal from user.
     */
    public function removeGoal(Request $request)
    {
        $request->validate([
            'goal_id' => 'required|exists:goals,id',
        ]);

        $user = Auth::user();
        $userGoal = UserGoal::where('user_id', $user->id)
                           ->where('goal_id', $request->goal_id)
                           ->first();

        if ($userGoal) {
            $userGoal->update([
                'is_active' => false,
                'completed_at' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Goal removed successfully',
        ]);
    }

    /**
     * Get exercises and nutrition items for a specific goal.
     */
    public function goalDetails($goalId)
    {
        $goal = Goal::with(['nutritionItems' => function ($query) {
            $query->where('is_active', true);
        }])->findOrFail($goalId);

        // Get exercises related to this goal category
        $exercises = \App\Models\Exercise::whereHas('exerciseType', function ($query) use ($goal) {
            $query->where('name', 'like', '%' . $goal->category . '%');
        })->where('is_active', true)->get();

        return response()->json([
            'goal' => $goal,
            'exercises' => $exercises,
            'nutrition_items' => $goal->nutritionItems,
        ]);
    }
}
