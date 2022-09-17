<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'helsswslo-world';
});

Route::get('pull-from-github','PullFromGithubController');
