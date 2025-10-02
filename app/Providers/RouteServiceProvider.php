<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Шлях до "домашнього" маршруту для вашого додатку.
     *
     * Зазвичай, користувача буде перенаправлено сюди після входу.
     *
     * @var string
     */
    public const HOME = '/my-cards';

    /**
     * Реєстрація маршрутів додатку.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
