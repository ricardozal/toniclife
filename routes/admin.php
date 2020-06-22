<?php

use Illuminate\Support\Facades\Route;

Route::get('/home',
    'AdminController@home')
    ->name('admin_home');
