<?php

use Illuminate\Support\Facades\Route;

Route::get('/',
    function(){
        return redirect('/home');
    });

Route::get('/home',
    'HomeController@index')
    ->name('branch_home');

/** Inventory **/
Route::get('/inventory',
    'InventoryController@index')
    ->name('branch_inventory_index');

Route::get('/inventory-content',
    'InventoryController@indexContent')
    ->name('branch_inventory_index_content');

Route::get('/inventory/create',
    'InventoryController@create')
    ->name('branch_inventory_create');

Route::post('/inventory/create',
    'InventoryController@createPost')
    ->name('branch_inventory_create_post');

Route::get('/inventory/update',
    'InventoryController@update')
    ->name('branch_inventory_update');

Route::post('/inventory/update',
    'InventoryController@updatePost')
    ->name('branch_inventory_update_post');

/** Product **/

Route::get('/product/{countryId}/search',
    'ProductController@search')
    ->name('branch_product_search');
