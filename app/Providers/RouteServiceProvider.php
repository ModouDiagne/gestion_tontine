<?php

namespace App\Providers;

use App\Models\Tontine;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Configuration du binding de modèle pour les slugs
        Route::bind('tontine', function ($value) {
            return Tontine::where('slug', $value)->firstOrFail();
        });

        // Configuration du binding pour les tours
        Route::bind('tour', function ($value, $route) {
            return $route->parameter('tontine')->tours()->findOrFail($value);
        });

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
