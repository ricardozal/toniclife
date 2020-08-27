<?php


namespace App\Http\Controllers\Branch;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function indexHome($locale)
    {
        app()->setLocale($locale);

        $language = app()->getLocale();

        session()->put('branch.home.index',$language);

        return view('branch.home.index');
    }
}
