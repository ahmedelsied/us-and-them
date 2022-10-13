<?php

namespace App\Support\Dashboard;

class ChangeLocalizationAction
{
    public function __invoke($locale)
    {
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
