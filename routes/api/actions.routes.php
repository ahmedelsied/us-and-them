<?php

use App\Http\Middleware\API\Assessment\ActivityLogAuthorize;
use App\Http\Middleware\API\Auth\AppAuthAlgorithm;

route_group(['namespace' => 'App\Http\Controllers\API\Action', 'prefix' => 'actions', 'middleware' => ['auth:sanctum']], function () {
    route_group('auth', function () {
        Route::post('login', 'LoginAction')->withoutMiddleware('auth:sanctum');
        Route::post('register', 'RegisterAction')->withoutMiddleware('auth:sanctum');
        Route::post('social', 'SocialAuthAction')->withoutMiddleware('auth:sanctum');
        Route::post('restore-account', 'RestoreAccountAction')->withoutMiddleware('auth:sanctum');
        // ->middleware([AppAuthAlgorithm::class,'throttle:1,60']);
        // Route::put('update-profile', 'UpdateProfileAction');
    });

    route_group('assessment',function(){
        Route::post('complete-application', 'CompleteApplicationAction');
        Route::post('answer-activity','AnswerActivityAction')->middleware(ActivityLogAuthorize::class);
        Route::post('treatment/answer-activity','AnswerTreatmentActivity');
    });
});