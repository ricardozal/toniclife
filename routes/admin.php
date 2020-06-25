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
