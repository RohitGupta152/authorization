<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
// use Illuminate\Support\Facades\Gate;
// use Illuminate\Http\Request;


// // Route::post('/register', [AuthController::class, 'register']);
// // Route::post('/login', [AuthController::class, 'login']);
// // Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// // Route::middleware('auth:sanctum')->group(function () {
// //     Route::get('/admin-dashboard', function (Request $request) {
// //         if (Gate::allows('isAdmin', $request->user())) {
// //             return response()->json(['message' => 'Welcome Admin']);
// //         }
// //         return response()->json(['message' => 'Access Denied'], 403);
// //     });

// //     Route::get('/subadmin-dashboard', function (Request $request) {
// //         if (Gate::allows('isSubAdmin', $request->user())) {
// //             return response()->json(['message' => 'Welcome Subadmin']);
// //         }
// //         return response()->json(['message' => 'Access Denied'], 403);
// //     });

// //     Route::get('/user-dashboard', function (Request $request) {
// //         if (Gate::allows('isUser', $request->user())) {
// //             return response()->json(['message' => 'Welcome User']);
// //         }
// //         return response()->json(['message' => 'Access Denied'], 403);
// //     });
// // });




// // Route::post('/register', [AuthController::class, 'register']);
// // Route::post('/login', [AuthController::class, 'login']);

// // Route::middleware('auth:sanctum')->group(function () {
// //     Route::post('/logout', [AuthController::class, 'logout']);
// //     Route::get('/user', [AuthController::class, 'getUser']); // Fetch authenticated user
// // });



// // // Public Routes
// // Route::post('/register', [AuthController::class, 'register']);
// // Route::post('/login', [AuthController::class, 'login']);

// // // Protected Routes
// // Route::middleware(['auth:sanctum'])->group(function () {

// //     Route::middleware(['role:1'])->group(function () {
// //         Route::get('/admin/dashboard', function () {
// //             return response()->json(['message' => 'Welcome, Admin']);
// //         });
// //     });

// //     Route::middleware(['role:2'])->group(function () {
// //         Route::get('/sub-admin/dashboard', function () {
// //             return response()->json(['message' => 'Welcome, Sub-Admin']);
// //         });
// //     });

// //     Route::middleware(['role:3'])->group(function () {
// //         Route::get('/user/dashboard', function () {
// //             return response()->json(['message' => 'Welcome, User']);
// //         });
// //     });

// //     // Example of allowing multiple roles
// //     Route::middleware(['role:1,2'])->group(function () {
// //         Route::get('/admin-subadmin-page', function () {
// //             return response()->json(['message' => 'Accessible by Admin and Sub-Admin']);
// //         });
// //     });

// //     // Logout Route
// //     Route::post('/logout', [AuthController::class, 'logout']);
// // });























// // Public Routes
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);

// // Protected Routes
// Route::middleware('auth:sanctum')->group(function () {

//     Route::post('/logout', [AuthController::class, 'logout']);

//     // Admin-only route
//     Route::post('/admin/dashboard', function () {
//         if (Gate::denies('isAdmin')) {
//             return response()->json(['message' => 'Access denied'], 403);
//         }
//         return response()->json(['message' => 'Welcome, Admin']);
//     });

//     // Sub-Admin-only route
//     Route::post('/sub-admin/dashboard', function () {
//         if (Gate::denies('isSubAdmin')) {
//             return response()->json(['message' => 'Access denied'], 403);
//         }
//         return response()->json(['message' => 'Welcome, Sub-Admin']);
//     });

//     // User-only route
//     Route::post('/user/dashboard', function () {
//         if (Gate::denies('isUser')) {
//             return response()->json(['message' => 'Access denied'], 403);
//         }
//         return response()->json(['message' => 'Welcome, User']);
//     });

// });















use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes with Sanctum Authentication
Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/logout', [AuthController::class, 'logout']);

    // // Admin Dashboard
    // Route::post('/admin/dashboard', [DashboardController::class, 'adminDashboard']);

    // // Sub-Admin Dashboard
    // Route::post('/sub-admin/dashboard', [DashboardController::class, 'subAdminDashboard']);

    // // User Dashboard
    // Route::post('/user/dashboard', [DashboardController::class, 'userDashboard']);

    // // **Admin or Sub-Admin Dashboard**
    // Route::post('/admin-sub-admin/dashboard', [DashboardController::class, 'adminOrSubAdminDashboard']);


    Route::post('/logout', [AuthController::class, 'logout']);

    // Admin & Sub-Admin Dashboard
    Route::post('/admin-sub-admin/dashboard', [AuthController::class, 'adminSubAdminDashboard']);

    // Admin Dashboard
    Route::post('/admin/dashboard', [AuthController::class, 'adminDashboard']);

    // Sub-Admin Dashboard
    Route::post('/sub-admin/dashboard', [AuthController::class, 'subAdminDashboard']);

    // User Dashboard
    Route::post('/user/dashboard', [AuthController::class, 'userDashboard']);

});
