<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;



return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    // ->withProviders([
        // App\Providers\AuthServiceProvider::class, // 
    // ])
    ->withMiddleware(function (Middleware $middleware) {
        // Register Global Middleware
        // $middleware->append([
        //     \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        // ]);
        // $middleware->validateCsrfTokens(except:[
        //     'api/admin/dashboard',
        // ]);

        // Register Route Middleware (Named Middleware)
        $middleware->alias([
            // 'role' => \App\Http\Middleware\RoleMiddleware::class, 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
        $exceptions->render(function (AuthenticationException $exception, $request) {
            $authorizationHeader = $request->header('Authorization');

            if (!$authorizationHeader) {
                return response()->json([
                    'message' => 'User is Unauthorized.'
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'message' => 'Token is Invalid.'
            ], Response::HTTP_UNAUTHORIZED);
        });

    })->create();
