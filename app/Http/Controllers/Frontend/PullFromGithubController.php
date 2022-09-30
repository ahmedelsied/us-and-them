<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PullFromGithubController extends Controller
{
    public function __invoke()
    {
        shell_exec('git reset --hard');
        shell_exec('git pull origin main');
        shell_exec('php '.base_path().'/artisan migrate');
        shell_exec('php '.base_path().'/artisan optimize:clear');
    }
}
