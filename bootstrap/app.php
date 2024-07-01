<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Mockery\Exception\InvalidOrderException;
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
            'isAdmin' => \App\Http\Middleware\isAdmin::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            '/webhook',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })->create();