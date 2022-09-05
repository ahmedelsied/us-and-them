<?php
Route::group(['prefix' => 'clients', 'namespace' => 'Clients','middleware'  =>  'auth:sanctum'], static function () {
    Route::get('assessments','GetAssessmentController')->name('assessments');
    Route::post('save-client-answers','SaveClientAssessmentAnswersController')->name('assessments');
    Route::group(['prefix' =>   'packages'],function(){
        Route::get('/','PackageController@index');
        Route::post('/subscribe/{package}','PackageController@subscribe');
    });
    Route::post('/add-feedback', 'AddFeedbackController');
});