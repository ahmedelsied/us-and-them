<?php

namespace Codebase\API\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            Route::prefix('app')
                 ->middleware('app-api')
                 ->namespace('Codebase\\API\\Http\\Controllers')
                 ->group(__DIR__.'/../routes/api_router.php');
        });
    }
}
