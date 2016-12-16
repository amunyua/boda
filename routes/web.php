<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'DashboardController@index');
Route::get('/home', 'DashboardController@index');

Auth::routes();

// Dashboard
Route::get('/dashboard', 'DashboardController@index');

// Registration Module
Route::get('/registration', 'MasterfileController@index');
Route::post('/add-registration', 'MasterfileController@store');
Route::get('edit-mf/{id}', 'MasterfileController@getMf');
Route::post('edit-mf/{id}', 'MasterfileController@updateMf');
Route::get('soft-delete-mf/{id}', 'MasterfileController@softDeleteMf');
Route::get('restore-mf/{id}', 'MasterfileController@restoreMf');
Route::get('delete-masterfile/{id}', 'MasterfileController@destroy');
Route::get('/all-clients', 'MasterfileController@allClients');
Route::get('/all-staffs', 'MasterfileController@allStaffs');
Route::get('/all-mfs', 'MasterfileController@allMfs');
Route::get('/inactive-users', 'MasterfileController@loadDelMfs');
Route::get('mf-profile/{id}', 'MasterfileController@getMfProfile');
Route::delete('delete-address/{id}', 'MasterfileController@deleteAddress');

// Contact Types Module
Route::resource('contact_types','ContactTypesController');

// System Manager
Route::get('/routes', 'RoutesController@index');
Route::post('/add-route', 'RoutesController@store');
Route::get('/get-route/{route_id}', 'RoutesController@getRoute');
Route::get('/parent-routes', 'RoutesController@getParentRoutes');
Route::post('/edit-route', 'RoutesController@update');
Route::get('/load-routes', 'RoutesController@loadRoutes');
Route::get('/delete-route/{id}', 'RoutesController@destroy');

Route::get('/menu', 'MenuController@index');
Route::post('/add-menu', 'MenuController@store');
Route::post('/arrange-menu', 'MenuController@arrangeMenu');
Route::post('/edit-menu', 'MenuController@update');
Route::get('/get-menu/{id}', 'MenuController@getMenuItem');
Route::post('/remove-menu', 'MenuController@destroy');

//theme configuration
Route::get('/theme_config', 'ThemeController@index');
Route::get('/theme-select/{theme}', 'ThemeController@saveSkin');
Route::get('/get-theme', 'ThemeController@getTheme');

Route::get('/categories','CategoryController@index');
Route::post('/add-category','CategoryController@storeCategory');

#####Database Backups
Route::get('/backups','DatabaseBackup@index');
Route::get('/make-backup','DatabaseBackup@runBackup');

##### User manager
Route::get('/user_roles','UserManagerController@getIndex');
Route::get('/all_users','UserManagerController@getAllUsers');
Route::get('/sys-config', 'UserManagerController@updateSystemConfig');
Route::get('/load-config', 'UserManagerController@loadSystemConfig');
Route::post('/add-user-role','UserManagerController@storeRole');
Route::get('get-role-edit-details/{id}','UserManagerController@getRoleEditDetails');
Route::post('edit-user-role/{id}','UserManagerController@updateUserRoleDetails');
Route::get('/delete-user/{id}','UserManagerController@destroyRole');
Route::get('/audit_trails','UserManagerController@auditTrails');
Route::get('/ajax_trails','UserManagerController@ajaxAuditTrails');
Route::get('/load-routes-allocation', 'UserManagerController@loadRoutesForAllocation');
Route::post('/attach-route', 'UserManagerController@attachRoute');
Route::post('/detach-route', 'UserManagerController@detachRoute');
Route::get('/check-allocated-route/{id}', 'UserManagerController@isRouteAllocated');
Route::post('all_users/block-user','UserManagerController@blockUser');
Route::post('all_users/unblock-user','UserManagerController@unblockUser');

#### Services
Route::get('/service-cats', 'ServiceCategoryController@index');
Route::get('/services', 'ServiceController@index');

#### Inventory
Route::get('/load-inventory-items','InventoryController@loadInventoryItems');
Route::get('inventory-categories','InventoryController@getCategories');
Route::post('/add-inventory-category','InventoryController@storeCategory');
Route::get('/manage_inventory','InventoryController@allInventoryItems');
Route::post('/create-inventory-item','InventoryController@storeInventory');
Route::post('/delete-inventory-item', 'InventoryController@deleteInventory');

Route::get('/bikes','BikeController@index');
Route::post('/store-bike','BikeController@store');
Route::get('/load-bikes','BikeController@getBikes');
Route::post('/delete-bike','BikeController@destroy');

//stock transactions
Route::get('/stock-transactions','InventoryController@stockTransactions');
Route::post('/create-transaction','StockTransactionController@createTransaction');
Route::get('/load-stock-transactions','StockTransactionController@loadTransactions');

Route::get('/service_category', 'ServiceCategoryController@index');
Route::post('/add-sc-cats', 'ServiceCategoryController@store');
Route::post('/edit-sc-cats', 'ServiceCategoryController@update');
Route::post('/delete-scats', 'ServiceCategoryController@destroy');
Route::get('/get-scat-details/{id}', 'ServiceCategoryController@getScat');
Route::get('/subcats/{id}','InventoryController@getSubCat');
Route::get('/get-inventory-edit-details/{id}','InventoryController@getIEditDetails');
Route::get('/manage_services', 'ServiceController@index');
Route::post('/add-service', 'ServiceController@store');
Route::post('/delete-service', 'ServiceController@destroy');
Route::post('/update-service', 'ServiceController@update');
Route::get('/get-service/{id}', 'ServiceController@getService');

#### Client Accounts
Route::get('/client_account','ClientAccountController@clientAccounts');
Route::post('/create-client-account','ClientAccountController@createAccount');
Route::get('/load-accounts','ClientAccountController@loadAccounts');
Route::post('/delete-client-account','ClientAccountController@destroyClientAccount');
Route::get('/get-client-account-details/{id}','ClientAccountController@getEditDetails');
Route::post('/edit-client-account','ClientAccountController@editClientAccount');
#### Access Denied
Route::get('/access-denied', function(){
    return view('pages.access_denied');
});
