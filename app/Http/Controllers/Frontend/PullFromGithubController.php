<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PullFromGithubController extends Controller
{
    public function __invoke()
    {
        $output = shell_exec('git pull origin main 2>&1');
        dd($output);
    }
}
