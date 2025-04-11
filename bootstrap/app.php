<?php

use App\Http\Middleware\LogVisitor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(LogVisitor::class);
        $middleware->alias([
            'checkTrainingEndDate' => \App\Http\Middleware\CheckTrainingEndDate::class,
            'prevent-if-paid'      => \App\Http\Middleware\PreventAccessIfPaymentProofUploaded::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
