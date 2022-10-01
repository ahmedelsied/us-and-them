<?php
route_group(['namespace' => 'App\Http\Controllers\API\Screen', 'prefix' => 'screen', 'middleware' => 'auth:sanctum'], function () {
        Route::get('assessment-result', 'ResultScreen');
        Route::get('stages','GetTreatmentStages');
        Route::get('stages/fields','GetTreatmentStagesFields');
});