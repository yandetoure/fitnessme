<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseType;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Get all exercise types.
     */
    public function types()
    {
        $types = ExerciseType::where('is_active', true)->get();

        return response()->json([
            'exercise_types' => $types,
        ]);
    }

    /**
     * Get exercises by type.
     */
    public function byType($typeId)
    {
        $exercises = Exercise::where('exercise_type_id', $typeId)
                            ->where('is_active', true)
                            ->with('exerciseType')
                            ->get();

        return response()->json([
            'exercises' => $exercises,
        ]);
    }

    /**
     * Get exercises by goal category.
     */
    public function byGoalCategory($category)
    {
        $exercises = Exercise::whereHas('exerciseType', function ($query) use ($category) {
            $query->where('name', 'like', '%' . $category . '%');
        })->where('is_active', true)
          ->with('exerciseType')
          ->get();

        return response()->json([
            'exercises' => $exercises,
        ]);
    }

    /**
     * Get exercise details.
     */
    public function show($id)
    {
        $exercise = Exercise::with('exerciseType')->findOrFail($id);

        return response()->json([
            'exercise' => $exercise,
        ]);
    }

    /**
     * Get exercises by difficulty.
     */
    public function byDifficulty($difficulty)
    {
        $exercises = Exercise::where('difficulty', $difficulty)
                            ->where('is_active', true)
                            ->with('exerciseType')
                            ->get();

        return response()->json([
            'exercises' => $exercises,
        ]);
    }
}
