<?php

namespace Codebase\API\Providers;

use Codebase\API\Support\Services\APIResponse\JsonResponder;
use Illuminate\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->singleton('api-responder', function () {
            return new JsonResponder();
        });
    }

    public function boot()
    {

    }
}
