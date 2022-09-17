<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'helsddlo-world';
});

Route::post('pull-from-github','PullFromGithubController');
