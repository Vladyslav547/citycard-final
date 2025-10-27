<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * RouteServiceProvider
 *
 * Registers the application's route groups and defines the default
 * post-login redirect path (HOME).
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Users will typically be redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/my-cards';

    /**
     * Register application routes.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->routes(function () {
            // Web routes
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // API routes
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
