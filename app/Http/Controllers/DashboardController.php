<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    
    // public function adminDashboard(Request $request)
    // {
    //     if (Gate::denies('isAdmin')) {
    //         return response()->json(['message' => 'Access denied - Admins only'], 403);
    //     }
    //     return response()->json(['message' => 'Welcome, Admin']);
    // }

    // public function subAdminDashboard(Request $request)
    // {
    //     if (Gate::denies('isSubAdmin')) {
    //         return response()->json(['message' => 'Access denied - Sub-Admins only'], 403);
    //     }
    //     return response()->json(['message' => 'Welcome, Sub-Admin']);
    // }

    // public function userDashboard(Request $request)
    // {
    //     if (Gate::denies('isUser')) {
    //         return response()->json(['message' => 'Access denied - Users only'], 403);
    //     }
    //     return response()->json(['message' => 'Welcome, User']);
    // }

    // public function adminOrSubAdminDashboard(Request $request)
    // {
    //     if (Gate::denies('isAdmin') && Gate::denies('isSubAdmin')) {
    //         return response()->json(['message' => 'Access denied - Admins or Sub-Admins only'], 403);
    //     }
    //     return response()->json(['message' => 'Welcome, Admin or Sub-Admin']);
    // }
}
