<?php

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
        'nocache' => \App\Http\Middleware\NoCache::class,
    ]);
    
    // Bunu eklediğinde her sayfada otomatik çalışır, 
    // geri tuşuyla eski verilerin görünmesini engeller.
    $middleware->appendToGroup('web', \App\Http\Middleware\NoCache::class);
})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();