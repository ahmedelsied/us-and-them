<?php

Route::group(['prefix' => 'data', 'namespace' => 'Data'], static function () {
    Route::group(['prefix' => 'screens', 'namespace' => 'Screens'], static function () {
        Route::get('/', 'BaseScreenController');
    });

    Route::get('/', 'BaseDataController');
});