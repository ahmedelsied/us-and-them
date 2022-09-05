<?php
Route::group(['prefix' => 'diets', 'middleware' =>  'auth:sanctum', 'namespace' => 'Diets'], static function () {
    Route::get('/','ClientDietController');
});