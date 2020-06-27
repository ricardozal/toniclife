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
 * *******   Branch *************
 **********************************/

Route::get('/branch',
    'BranchController@index')
    ->name('admin_branch_index');

Route::get('/branch-content',
    'BranchController@indexContent')
    ->name('admin_branch_index_content');

Route::get('/branch/create',
    'BranchController@create')
    ->name('admin_branch_create');

Route::post('/branch/create',
    'BranchController@createPost')
    ->name('admin_branch_create_post');

Route::get('/branch/{branchId}/update',
    'BranchController@update')
    ->name('admin_branch_update');

Route::post('/branch/{branchId}/update',
    'BranchController@updatePost')
    ->name('admin_branch_update_post');

Route::get('/branch/{branchId}/active',
    'BranchController@active')
    ->name('admin_branch_active');

Route::get('/branch/{branchId}/delete',
    'BranchController@delete')
    ->name('admin_branch_delete');


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

Route::get('/distributor/search',
    'DistributorController@search')
    ->name('admin_distributor_search');

/***********************************
 * *******   Country *************
 **********************************/

Route::get('/country',
    'CountryController@index')
    ->name('admin_country_index');

Route::get('/country-content',
    'CountryController@indexContent')
    ->name('admin_country_index_content');

Route::get('/country/create',
    'CountryController@create')
    ->name('admin_country_create');

Route::post('/country/create',
    'CountryController@createPost')
    ->name('admin_country_create_post');

Route::get('/country/{countryId}/update',
    'CountryController@update')
    ->name('admin_country_update');

Route::post('/country/{countryId}/update',
    'CountryController@updatePost')
    ->name('admin_country_update_post');

Route::get('/country/{countryId}/active',
    'CountryController@active')
    ->name('admin_country_active');

Route::get('/country/{countryId}/delete',
    'CountryController@delete')
    ->name('admin_country_delete');
/***********************************
 * *******   Inventory *************
 **********************************/
Route::get('/inventory',
    'InventoryController@index')
    ->name('admin_inventory_index');

Route::get('/inventory-content',
    'InventoryController@indexContent')
    ->name('admin_inventory_index_content');

/***********************************
 * *******   Organization Chart ****
 **********************************/

Route::get('/org-chart',
    'OrganizationChartController@index')
    ->name('admin_org_chart_index');

Route::post('/org-chart-content',
    'OrganizationChartController@indexContent')
    ->name('admin_org_chart_index_content');
