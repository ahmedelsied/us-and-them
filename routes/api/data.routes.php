<?php
route_group(['namespace' => 'App\Http\Controllers\API\Data', 'prefix' => 'data', 'middleware' => 'auth:sanctum'], function () {
        Route::get('user-checkpoint', 'GetUserCheckpoint');
        Route::get('activities/{field}', 'GetActivities');
});