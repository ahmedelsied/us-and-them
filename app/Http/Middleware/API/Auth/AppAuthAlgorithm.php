<?php

namespace App\Http\Middleware\API\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppAuthAlgorithm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($this->isCorrectAlgorithmOutput($request)){
            return $next($request);
        }
        abort(403);
    }

    private function isCorrectAlgorithmOutput($request)
    {
        $base = '$2y$10$9JZoJDlaR8/uxoQRpVembeKPBnJwn7qpCow9p6QMYxnpBPvWpa3Ua';
        // dd(hash('sha1',$base));
        return ($request->hasHeader('Auth-Header') && Hash::check($base,$request->header('Auth-Header')));
    }
}
