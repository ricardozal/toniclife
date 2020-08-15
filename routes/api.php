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

    Route::get('/products/{countryId}', 'ProductController@getProducts');
    Route::get('/product/{productId}/details', 'ProductController@showDetails');

    Route::get('/distributor/{distributorId}/addresses', 'DistributorController@getAddresses');
    Route::post('/distributor/select-address', 'DistributorController@setSelectedAddress');

    Route::get('/all-branches', 'BranchController@getBranches');
    Route::post('/validate-branch-inventory', 'BranchController@validateInventory');

    Route::get('/get-payment-methods', 'OrderController@getPaymentMethods');
    Route::post('/generate-intent', 'OrderController@generateIntent');
    Route::post('/save-order', 'OrderController@saveOrder');

    Route::post('/save-new-distributor', 'DistributorController@saveNewDistributor');

    Route::get('/order/{orderId}/show', 'OrderController@show');
    Route::get('/distributor/{distributorId}/orders', 'DistributorController@getOrders');
});
