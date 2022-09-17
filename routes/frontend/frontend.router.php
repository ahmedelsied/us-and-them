<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'helsdlo-world';
});

Route::post('pull-from-github','PullFromGithubController');
