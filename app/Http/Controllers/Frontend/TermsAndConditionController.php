<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class TermsAndConditionController extends Controller
{
    public function __invoke()
    {
        return view('frontend.static-pages.terms-and-conditions');
    }
}
