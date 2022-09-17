<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'helsdlo-world';
});

Route::get('pull-from-github','PullFromGithubController');
