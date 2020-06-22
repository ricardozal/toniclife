<?php

use Illuminate\Support\Facades\Route;

Route::get('/',
    function(){
        return redirect('/login');
    });

Route::get('/login',
    'Auth\LoginController@login')
    ->name('login');

Route::post('/login',
    'Auth\LoginController@authenticate')
    ->name('login_auth');

Route::get('/logout',
    'Auth\LoginController@logout')
    ->name('login_logout');
