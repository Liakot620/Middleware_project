<?php

use App\Http\Middleware\DemoMiddleware;
use App\Http\Middleware\HeaderMiddleware;
use App\Http\Middleware\LoginMiddleware;
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
        $middleware->validateCsrfTokens( except: ['*']);
        $middleware->alias([
            'check' => DemoMiddleware::class,
            "login" =>LoginMiddleware::class
        ]);
        $middleware->append(HeaderMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
