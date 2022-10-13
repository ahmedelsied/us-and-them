<?php

namespace App\Providers;

use HsmFawaz\UI\Providers\UIServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(UIServiceProvider::class);
    }

    public function boot()
    {
        if(request()->header('Accept-Language') == 'ar' || request()->header('Accept-Language') == 'en'){
            app()->setLocale(request()->header('Accept-Language'));
        }
        Validator::includeUnvalidatedArrayKeys();
        View::composer('ui::layout.master', static function ($view) {
            $routes = require resource_path('sidebar/sidebar.php');
            $view->with('sidebarRoutes', $routes);
        });
    }
}
