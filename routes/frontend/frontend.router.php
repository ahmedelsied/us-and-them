<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'hello-world';
});

Route::get('pull-from-github','PullFromGithubController');
