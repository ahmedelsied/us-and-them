<?php
Route::group(['prefix' => 'actions', 'namespace' => 'Actions'], static function () {
    Route::post('/invitation-code', 'StoreInvitaionCodeAction')->middleware('auth:sanctum');
});