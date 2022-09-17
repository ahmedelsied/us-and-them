<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PullFromGithubController extends Controller
{
    public function __invoke()
    {
        shell_exec('git pull origin main');
        $output = shell_exec('php artisan migrate 2>&1');
        dd($output);
    }
}
