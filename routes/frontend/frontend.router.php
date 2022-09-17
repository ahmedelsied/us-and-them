<?php

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'helsdsdlo-world';
});

Route::post('pull-from-github','PullFromGithubController')->withoutMiddleware([VerifyCsrfToken::class]);
