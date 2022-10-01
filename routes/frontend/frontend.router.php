<?php

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'hello-world';
});

Route::post('pull-from-github','PullFromGithubController')->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('terms-and-conditions','StaticPagesController@terms');
Route::get('privacy-and-policies','StaticPagesController@privacy');