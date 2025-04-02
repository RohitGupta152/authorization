<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Auth\Access\AuthorizationException;


class AuthController extends Controller
{
    use AuthorizesRequests;

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $user->remember_token = $token;
        $user->save();

        // Define user type mapping
        $userTypeMapping = [
            1 => 'Admin',
            2 => 'Sub-Admin',
            3 => 'User',
        ];

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'user_type' => $userTypeMapping[$user->user_type] ?? 'Unknown',
                'created_at' => $user->created_at->format('d M Y h:i A'),
                'updated_at' => $user->updated_at->format('d M Y h:i A'),
            ]
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'user_type' => 'required|integer|in:1,2,3' // 1 = Admin, 2 = Sub-Admin, 3 = User
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    public function logout(Request $request)
    {
        // Auth::user()->tokens()->delete();
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }





    

        public function adminSubAdminDashboard(Request $request)
        {
            $user = $request->user();
            abort_if(!$user, 401, 'Unauthorized - You need to log in first.');
    
            try {
                $this->authorize('isAdminOrSubAdmin', $user);
                return response()->json(['message' => 'Access granted: Welcome to the Admin & Sub-Admin Dashboard.'], 200);
            } catch (AuthorizationException $e) {
                return response()->json(['error' => 'Access denied: Only Admins and Sub-Admins can access this dashboard.'], 403);
            }
        }
    
        /**
         * Admin Dashboard
         */
        public function adminDashboard(Request $request)
        {
            $user = $request->user();
            abort_if(!$user, 401, 'Unauthorized - You need to log in first.');
    
            try {
                $this->authorize('isAdmin', $user);
                return response()->json(['message' => 'Access granted: Welcome to the Admin Dashboard.'], 200);
            } catch (AuthorizationException $e) {
                return response()->json(['error' => 'Access denied: Only Admins can access this dashboard.'], 403);
            }
        }
    
        /**
         * Sub-Admin Dashboard
         */
        public function subAdminDashboard(Request $request)
        {
            $user = $request->user();
            abort_if(!$user, 401, 'Unauthorized - You need to log in first.');
    
            try {
                $this->authorize('isSubAdmin', $user);
                return response()->json(['message' => 'Access granted: Welcome to the Sub-Admin Dashboard.'], 200);
            } catch (AuthorizationException $e) {
                return response()->json(['error' => 'Access denied: Only Sub-Admins can access this dashboard.'], 403);
            }
        }
    
        /**
         * User Dashboard
         */
        public function userDashboard(Request $request)
        {
            $user = $request->user();
            abort_if(!$user, 401, 'Unauthorized - You need to log in first.');
    
            try {
                $this->authorize('isUser', $user);
                return response()->json(['message' => 'Access granted: Welcome to the User Dashboard.'], 200);
            } catch (AuthorizationException $e) {
                return response()->json(['error' => 'Access denied: Only regular users can access this dashboard.'], 403);
            }
        }


}
