<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'contact', 'as' => 'contact.', 'namespace' => 'Contact'], function () {
    Route::resource('careers', 'CareerController')->only(['index','destroy']);
    Route::resource('contact-messages', 'ContactMessageController')->only(['index','destroy']);
});
