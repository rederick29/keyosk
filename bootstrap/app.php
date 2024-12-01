<?php

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            SecurityHeaders::class, // Add security headers
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle 404 errors if .htaccess doesn't catch them
        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            return redirect('/');
        });
    })->create();
