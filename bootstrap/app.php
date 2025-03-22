<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(
    basePath: dirname(__DIR__)
)
->withRouting(
    web: __DIR__.'/../routes/web.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)
->withMiddleware(function (Middleware $middleware) {
    // グローバルミドルウェアの登録
    $middleware->append([
        \App\Http\Middleware\TrustProxies::class,
        // 他に登録したいミドルウェアがあればここに追記
    ]);
})
->withExceptions(function (Exceptions $exceptions) {
    // 例外ハンドリングのカスタマイズが必要であればここに記述
})
->create();
