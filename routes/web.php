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

/***********************************
 * *******   Organization Chart ****
 **********************************/

Route::get('/{tonic_life_id}/org-chart-dist',
    'Web\OrganizationChartDistributorsController@index')
    ->name('web_org_chart_index');

Route::get('/{tonic_life_id}/org-chart-content-dist',
    'Web\OrganizationChartDistributorsController@indexContent')
    ->name('web_org_chart_index_content');

/***********************************
 * *******   PDF Documents ****
 **********************************/

Route::get('/business_plan', function (){
    return response()->file(public_path('/PDF/COVID-19.pdf'));
});
