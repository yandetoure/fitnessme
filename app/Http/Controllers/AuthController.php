<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20|unique:users',
            'country_code' => 'required|string|max:10',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'country_code' => $request->country_code,
        ]);

        // Auto-login after registration
        Auth::login($user);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    /**
     * Login with phone number.
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'country_code' => 'required|string|max:10',
        ]);

        $user = User::where('phone_number', $request->phone_number)
                    ->where('country_code', $request->country_code)
                    ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phone_number' => ['No user found with this phone number.'],
            ]);
        }

        Auth::login($user);

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
        ]);
    }

    /**
     * Verify user identity for login.
     */
    public function verifyIdentity(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'country_code' => 'required|string|max:10',
        ]);

        $user = User::where('phone_number', $request->phone_number)
                    ->where('country_code', $request->country_code)
                    ->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'exists' => false,
            ], 404);
        }

        return response()->json([
            'message' => 'User found',
            'exists' => true,
            'user' => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'phone_number' => $user->phone_number,
                'country_code' => $user->country_code,
            ],
        ]);
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Get the authenticated user.
     */
    public function user(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }
}
