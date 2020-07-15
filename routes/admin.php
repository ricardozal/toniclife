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

Route::get('/order/{orderId}/show',
    'OrderController@show')
    ->name('admin_order_show');



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
 * *******   Inventory - Menu *****
 **********************************/
Route::get('/inventory',
    'Inventory\MenuController@index')
    ->name('admin_inventory_index');

/** Inventory Local **/
Route::get('/inventory/{branchId}/local',
    'Inventory\InventoryLocalController@indexLocal')
    ->name('admin_inventory_local_index');

Route::get('/inventory/{branchId}/local-content',
    'Inventory\InventoryLocalController@indexContent')
    ->name('admin_inventory_local_index_content');

Route::get('/inventory/local/{branchId}/create',
    'Inventory\InventoryLocalController@createLocal')
    ->name('admin_inventory_local_create');

Route::post('/inventory/local/create',
    'Inventory\InventoryLocalController@createPost')
    ->name('admin_inventory_local_create_post');

Route::get('/inventory/local/{branchId}/update',
    'Inventory\InventoryLocalController@update')
    ->name('admin_inventory_local_update');

Route::post('/inventory/local/{branchId}/update',
    'Inventory\InventoryLocalController@updatePost')
    ->name('admin_inventory_local_update_post');

Route::get('/inventory/local/{branchId}/delete',
    'Inventory\InventoryLocalController@delete')
    ->name('admin_inventory_local_delete');


/** Inventory Global **/
Route::get('/inventory/global',
    'Inventory\InventoryGlobalController@indexGlobal')
    ->name('admin_inventory_global_index');

Route::get('/inventory/global-content',
    'Inventory\InventoryGlobalController@indexContent')
    ->name('admin_inventory_global_index_content');

Route::get('/inventory/{fk_id_product}/show',
    'Inventory\InventoryGlobalController@show')
    ->name('admin_inventory_global_show');

Route::get('/inventory/{fk_id_product}/showMovements',
    'Inventory\InventoryGlobalController@showMovements')
    ->name('admin_inventory_global_showMovements');

Route::get('/inventory/{fk_id_product}/showTableMovements',
    'Inventory\InventoryGlobalController@showTableMovements')
    ->name('admin_inventory_global_showTableMovements');

Route::get('/inventory/{fk_id_product}/createMovement',
    'Inventory\InventoryGlobalController@createMovement')
    ->name('admin_inventory_global_branchToBranch');

Route::post('/inventory/{fk_id_product}/createMovement',
    'Inventory\InventoryGlobalController@createPostMovement')
    ->name('admin_inventory_global_showTableMovements_post');

/***********************************
 * *******   Organization Chart ****
 **********************************/

Route::get('/org-chart',
    'OrganizationChartController@index')
    ->name('admin_org_chart_index');

Route::post('/org-chart-content',
    'OrganizationChartController@indexContent')
    ->name('admin_org_chart_index_content');

/***********************************
 * *******   Products **************
 **********************************/

Route::get('/product',
    'ProductController@index')
    ->name('admin_product_index');

Route::get('product-content',
    'ProductController@indexContent')
    ->name('admin_product_index_content');

Route::get('/product/create',
    'ProductController@create')
    ->name('admin_product_create');

Route::post('/product/create',
    'ProductController@createPost')
    ->name('admin_product_create_post');

Route::get('/product/{productId}/update',
    'ProductController@update')
    ->name('admin_product_update');

Route::post('/product/{productId}/update',
    'ProductController@updatePost')
    ->name('admin_product_update_post');

Route::get('/product/{productId}/active',
    'ProductController@active')
    ->name('admin_product_active');

Route::get('/product/{productId}/image',
    'ProductController@image')
    ->name('admin_product_image');

Route::get('/product/search',
    'ProductController@search')
    ->name('admin_product_search');

/***********************************
 * *******   Reorder  *************
 **********************************/


Route::get('/reorder',
    'ReorderController@index')
    ->name('admin_reorder_index');

Route::get('/reorder-content',
    'ReorderController@indexContent')
    ->name('admin_reorder_index_content');

Route::get('/reorder/{reorderId}/show',
    'ReorderController@show')
    ->name('admin_reorder_show');

/***********************************
 * *******   Kits  **************
 **********************************/

Route::get('/kits',
    'KitsController@index')
    ->name('admin_kits_index');

Route::get('/kits-content',
    'KitsController@indexContent')
    ->name('admin_kits_index_content');

Route::get('/kits/{idNewDistributor}/showInformation',
    'KitsController@showInformation')
    ->name('admin_kits_show_information');

Route::get('/kits/{idNewDistributor}/showTicket',
    'KitsController@showTicket')
    ->name('admin_kits_show_ticket');
/***********************************
 * *******   Category  *************
 **********************************/

Route::get('/category',
    'CategoryController@index')
    ->name('admin_category_index');

Route::get('/category-content',
    'CategoryController@indexContent')
    ->name('admin_category_index_content');

Route::get('/category/create',
    'CategoryController@create')
    ->name('admin_category_create');

Route::post('/category/create',
    'CategoryController@createPost')
    ->name('admin_category_create_post');

Route::get('/category/{categoryId}/update',
    'CategoryController@update')
    ->name('admin_category_update');

Route::post('/category/{categoryId}/update',
    'CategoryController@updatePost')
    ->name('admin_category_update_post');

Route::get('/category/{categoryId}/active',
    'CategoryController@active')
    ->name('admin_category_active');

Route::get('/category/{categoryId}/delete',
    'CategoryController@delete')
    ->name('admin_category_delete');

/***********************************
 * *******   Shipping - Menu *****
 **********************************/
Route::get('/shipping',
    'shipping\MenuController@index')
    ->name('admin_shipping_index_menu');

/** Shipping to branch **/

Route::get('/shipping/shippingToBranch',
    'shipping\ShippingToBranchController@indexShipping')
    ->name('admin_shipping_branch_index');

Route::get('/shipping/shippingToBranch-content',
    'shipping\ShippingToBranchController@indexContent')
    ->name('admin_shippingToBranch_index_content');

Route::get('/shipping/{orderId}/showShippingToBranch-ticket',
    'shipping\ShippingToBranchController@show')
    ->name('admin_shippingToBranch_show');

Route::get('/shipping/{orderId}/showShippingToBranch-status',
    'shipping\ShippingToBranchController@updateStatus')
    ->name('admin_shippingToBranch_updateStatus');

Route::post('/shipping/{orderId}/showShippingToBranch-statusUpdate',
    'shipping\ShippingToBranchController@updatePostStatus')
    ->name('admin_shippingToBranch_statusUpdatePost');

/** Shipping **/

Route::get('/shipping/shipping',
    'shipping\ShippingController@index')
    ->name('admin_shipping_index');

Route::get('/shipping/shipping-content',
    'shipping\ShippingController@indexContent')
    ->name('admin_shipping_index_content');
