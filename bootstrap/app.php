<?php

use App\Http\Middleware\AuthStatic;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.static' => AuthStatic::class,
            'role'        => RoleMiddleware::class,   // ← TAMBAH
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
