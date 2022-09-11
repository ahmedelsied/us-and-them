<?php
route_group(['namespace' => 'App\Http\Controllers\API\Action', 'prefix' => 'actions', 'middleware' => ['auth:sanctum']], function () {
    route_group('auth', function () {
        Route::post('login', 'LoginAction')->withoutMiddleware('auth:sanctum');
        Route::post('register', 'RegisterAction')->withoutMiddleware('auth:sanctum');
    });

    route_group('assessment',function(){
        Route::post('complete-application', 'CompleteApplicationAction');
    });
});