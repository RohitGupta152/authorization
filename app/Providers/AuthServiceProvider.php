<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// class AuthServiceProvider extends ServiceProvider
// {
//     /**
//      * Register services.
//      */
//     public function register(): void {

//     }

//     /**
//      * Bootstrap services.
//      */

//     public function boot()
//     {
//         // $new = 
//         $this->registerPolicies();
//         // dd($new);

//         // Define Gates for user roles
//         Gate::define('isAdmin', function (User $user) {
//             return $user->user_type === 1;
//         });

//         Gate::define('isSubAdmin', function (User $user) {
//             return $user->user_type === 2;
//         });

//         Gate::define('isUser', function (User $user) {
//             return $user->user_type === 3;
//         });

//         Gate::define('isAdminOrSubAdmin', function (User $user) {
//             return in_array($user->user_type, [1, 2]);
//         });
//     }
// }

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}

