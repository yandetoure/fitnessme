<?php declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\NutritionController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/verify-identity', [AuthController::class, 'verifyIdentity']);

// Routes pour les liens de navigation (redirection vers la page d'accueil)
Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::get('/register', function () {
    return redirect('/');
})->name('register');

// Routes protégées
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/goals/{goal}', [DashboardController::class, 'goalDetails'])->name('goal.details');

    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/user', [AuthController::class, 'user']);

    // Goals
    Route::get('/goals', [GoalController::class, 'index']);
    Route::get('/user/goals', [GoalController::class, 'userGoals']);
    Route::post('/user/goals', [GoalController::class, 'selectGoal']);
    Route::delete('/user/goals/{goal}', [GoalController::class, 'removeGoal']);
    Route::get('/goals/{goal}/details', [GoalController::class, 'goalDetails']);

    // Exercises
    Route::get('/exercises/types', [ExerciseController::class, 'types']);
    Route::get('/exercises/type/{type}', [ExerciseController::class, 'byType']);
    Route::get('/exercises/category/{category}', [ExerciseController::class, 'byGoalCategory']);
    Route::get('/exercises/{exercise}', [ExerciseController::class, 'show']);
    Route::get('/exercises/difficulty/{difficulty}', [ExerciseController::class, 'byDifficulty']);

    // Nutrition
    Route::get('/nutrition', [NutritionController::class, 'index']);
    Route::get('/nutrition/type/{type}', [NutritionController::class, 'byType']);
    Route::get('/nutrition/category/{category}', [NutritionController::class, 'byCategory']);
    Route::get('/nutrition/{item}', [NutritionController::class, 'show']);
    Route::get('/nutrition/weight-loss', [NutritionController::class, 'weightLoss']);
    Route::get('/nutrition/weight-gain', [NutritionController::class, 'weightGain']);
    Route::get('/nutrition/tisanes', [NutritionController::class, 'tisanes']);
    Route::get('/nutrition/plats', [NutritionController::class, 'plats']);
});
