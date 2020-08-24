<?php


namespace App\Http\Controllers\Branch;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function indexHome($locale)
    {
        app()->setLocale($locale);

        $language = app()->getLocale();

//        session()->put('idioma',$language);

        return view('branch.home.index');
    }
}
