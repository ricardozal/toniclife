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

/***********************************
 * *******   Distributor ***********
 **********************************/

Route::get('/distributor',
    'DistributorController@index')
    ->name('admin_distributor_index');

Route::get('/distributor-content',
    'DistributorController@indexContent')
    ->name('admin_distributor_index_content');

Route::get('/distributor/create',
    'DistributorController@create')
    ->name('admin_distributor_create');

Route::post('/distributor/create',
    'DistributorController@createPost')
    ->name('admin_distributor_create_post');

Route::get('/distributor/{distributorId}/update',
    'DistributorController@update')
    ->name('admin_distributor_update');

Route::post('/distributor/{distributorId}/update',
    'DistributorController@updatePost')
    ->name('admin_distributor_update_post');

Route::get('/distributor/{distributorId}/active',
    'DistributorController@active')
    ->name('admin_distributor_active');

Route::get('/distributor/{distributorId}/delete',
    'DistributorController@delete')
    ->name('admin_distributor_delete');
