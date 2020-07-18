<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth'
], function () {

    Route::post(
        '/login',
        'AuthController@login'
    );

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
    });

});

Route::group([
    'middleware' => 'auth:api'
], function() {

    Route::get('/products', 'ProductController@getProducts');
    Route::get('/product/{productId}/details', 'ProductController@showDetails');

});
