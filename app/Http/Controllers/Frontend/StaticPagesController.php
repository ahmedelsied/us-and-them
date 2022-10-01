<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class StaticPagesController extends Controller
{
    public function terms()
    {
        return view('frontend.static-pages.terms-and-conditions');
    }

    public function privacy()
    {
        return view('frontend.static-pages.privacy-and-policy');
    }
}
