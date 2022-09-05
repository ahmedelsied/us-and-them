<?php
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], static function () {

    Route::put('update-profile','UpdateProfileController')->middleware('auth:sanctum');
    Route::post('check-mobile','CheckMobileController');
    Route::post('send-verification-code','SendVerificationCodeController');
    Route::post('register','RegisterController');
    Route::post('verify-code','VerifyCodeController');

});