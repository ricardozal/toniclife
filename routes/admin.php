<?php

use Illuminate\Support\Facades\Route;

Route::get('/',
    function(){
        return redirect('/home');
    });

Route::get('/home',
    'HomeController@index')
    ->name('admin_home');
