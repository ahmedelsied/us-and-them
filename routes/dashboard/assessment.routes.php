<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'assessments', 'as' => 'assessment.', 'namespace' => 'Assessment'], function () {

        Route::apiResource('fields', 'FieldController');

        Route::apiResource('age-activities', 'AgeActivityController');
        
        Route::put('save-age-activities-sorting', 'AgeActivityController@saveSorting')->name('age-activities.save_sorting');

        Route::resource('activities', 'ActivityController');

        Route::get('get-fields', 'ActivityController@getFields')->name('activities.get_fields');

        Route::put('save-activities-sorting', 'ActivityController@saveSorting')->name('activities.save_sorting');

});
