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

    Route::get('/products/{countryId}/{productName}', 'ProductController@getProducts');
    Route::get('/product/{productId}/details', 'ProductController@showDetails');

    Route::get('/distributor/{distributorId}/addresses', 'DistributorController@getAddresses');
    Route::post('/distributor/select-address', 'DistributorController@setSelectedAddress');

    Route::get('/distributor/{distributorId}/all-branches', 'BranchController@getBranches');
    Route::post('/distributor/{distributorId}/validate-branch-inventory', 'BranchController@validateInventory');

    Route::get('/get-payment-methods', 'OrderController@getPaymentMethods');
    Route::post('/generate-intent', 'OrderController@generateIntent');
    Route::post('/save-order', 'OrderController@saveOrder');

    Route::post('/save-new-distributor', 'DistributorController@saveNewDistributor');

    Route::get('/order/{orderId}/show', 'OrderController@show');
    Route::get('/distributor/{distributorId}/orders', 'DistributorController@getOrders');
    Route::get('/distributor/{distributorId}/promotions', 'DistributorController@getPromotions');

    Route::get('/distributor/{distributorId}/address/{addressId}/show', 'DistributorController@getAddress');
    Route::post('/distributor/{distributorId}/save-address', 'DistributorController@saveAddress');

    Route::get('/distributor/{distributorId}/bank-data/show', 'DistributorController@getBankData');
    Route::post('/distributor/{distributorId}/save-bank-data', 'DistributorController@saveBankData');

    Route::post('/distributor/{distributorId}/save-firebase-token', 'DistributorController@saveFirebaseToken');

    Route::get('/distributor/{distributorId}/order/{orderId}/my-distributors','DistributorController@getMyDistributors');
    Route::post('/distributor/register-points','DistributorController@registerPoints');

    Route::get('/order/{orderId}/validate-register-points', 'OrderController@validateRegisterPoints');

    Route::post('/distributor/share-points', 'SharePointsController@getCandidates');

    Route::post('/save-order-external-points', 'OrderController@saveOrderWithExternalPoints');

    Route::get('/content-app-mobile', 'AppContentController@content');
});
