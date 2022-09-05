<?php
Route::group(['prefix' => 'workouts', 'namespace' => 'Workouts','middleware' => 'auth:sanctum'], static function () {
    Route::group(['prefix'  =>  'exercieses'],function(){
        Route::post('new-record','AddNewWeightLogController');
        Route::get('client-records','GetClientWeightLogController');
    });
    Route::get('workout-types','GetWorkoutTypesController');
    Route::get('client-workout/{workout}','GetClientWorkoutController');
});