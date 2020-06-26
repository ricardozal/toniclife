<?php

use Illuminate\Support\Facades\Route;

Route::get('/',
    function(){
        return redirect('/home');
    });

Route::get('/home',
    'HomeController@index')
    ->name('admin_home');

/***********************************
 * *******   User *************
 **********************************/

Route::get('/user',
    'UserController@index')
    ->name('admin_user_index');

Route::get('/user-content',
    'UserController@indexContent')
    ->name('admin_user_index_content');

Route::get('/user/create',
    'UserController@create')
    ->name('admin_user_create');

Route::post('/user/create',
    'UserController@createPost')
    ->name('admin_user_create_post');

Route::get('/user/{userId}/update',
    'UserController@update')
    ->name('admin_user_update');

Route::post('/user/{userId}/update',
    'UserController@updatePost')
    ->name('admin_user_update_post');

Route::get('/user/{userId}/active',
    'UserController@active')
    ->name('admin_user_active');

Route::get('/user/{userId}/delete',
    'UserController@delete')
    ->name('admin_user_delete');


/***********************************
 * *******   Promotions  *************
 **********************************/

Route::get('/promotion',
    'PromotionController@index')
    ->name('admin_promotion_index');

Route::get('/promotion-content',
    'PromotionController@indexContent')
    ->name('admin_promotion_index_content');

Route::get('/promotion/create',
    'PromotionController@create')
    ->name('admin_promotion_create');

Route::post('/promotion/create',
    'PromotionController@createPost')
    ->name('admin_promotion_create_post');

Route::get('/promotion/{promotionId}/update',
    'PromotionController@update')
    ->name('admin_promotion_update');

Route::post('/promotion/{promotionId}/update',
    'PromotionController@updatePost')
    ->name('admin_promotion_update_post');

Route::get('/promotion/{promotionId}/active',
    'PrmotionController@active')
    ->name('admin_promotion_active');

Route::get('/promotion/{promotionId}/delete',
    'PromotionController@delete')
    ->name('admin_promotion_delete');

/***********************************
 * *******   Order  *************
 **********************************/


Route::get('/order',
    'OrderController@index')
    ->name('admin_order_index');

Route::get('/order-content',
    'OrderController@indexContent')
    ->name('admin_order_index_content');

Route::get('/order/create',
    'OrderController@create')
    ->name('admin_order_create');

Route::post('/order/create',
    'OrderController@createPost')
    ->name('admin_order_create_post');

Route::get('/order/{orderId}/update',
    'OrderController@update')
    ->name('admin_order_update');

Route::post('/order/{orderId}/update',
    'OrderController@updatePost')
    ->name('admin_order_update_post');

Route::get('/order/{orderId}/active',
    'OrderController@active')
    ->name('admin_order_active');

Route::get('/order/{orderId}/delete',
    'OrderController@delete')
    ->name('admin_order_delete');
