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
Route::post('/update-masterfile', 'MasterfileController@update');
Route::delete('/delete-masterfile', 'MasterfileController@destroy');
Route::get('/all-masterfiles', 'MasterfileController@allMfs');

// Contact Types Module
Route::resource('contact_types','ContactTypesController');

// Classes Module
Route::get('/class', 'FormsController@index');
Route::post('/add_class', 'FormsController@store');
Route::post('/manage_stream/{id}', 'FormsController@update');
Route::delete('/manage_stream/{id}', 'FormsController@destroy');

Route::resource('contact_types','ContactTypesController');

// subject module
Route::get('/subject', 'SubjectController@index');
Route::post('/add-subject','SubjectController@store');
Route::post('/update-subject','SubjectController@update');
Route::get('/delete-subject/{id}','SubjectController@delete');
Route::get('/subject_data/{subject_id}', 'SubjectController@getSubjectData');
Route::post('/update-subject/{id}','SubjectController@update');
Route::get('/delete-subject/{id}','SubjectController@delete');

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
Route::get('/theme_config', 'ThemeController@index');
Route::get('/theme-select/{theme}', 'ThemeController@saveSkin');
Route::get('/get-theme', 'ThemeController@getTheme');

#### inventory module
// category

Route::get('/categories','CategoryController@index');
Route::post('/add-category','CategoryController@storeCategory');

#####Database Backups
Route::get('/backups','DatabaseBackup@index');
Route::get('/make-backup','DatabaseBackup@runBackup');

##### User manager
Route::get('/user_roles','UserManagerController@getIndex');
Route::post('/add-user-role','UserManagerController@storeRole');
Route::get('get-role-edit-details/{id}','UserManagerController@getRoleEditDetails');
Route::post('edit-user-role/{id}','UserManagerController@updateUserRoleDetails');
Route::delete('/delete-user-role/{id}','UserManagerController@destroyRole');
Route::get('/audit_trails','UserManagerController@auditTrails');
Route::get('/ajax_trails','UserManagerController@ajaxAuditTrails');
Route::get('/load-routes-allocation', 'UserManagerController@loadRoutesForAllocation');
Route::post('/attach-route', 'UserManagerController@attachRoute');
Route::post('/detach-route', 'UserManagerController@detachRoute');
Route::get('/check-allocated-route/{id}', 'UserManagerController@isRouteAllocated');

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

#### Access Denied
Route::get('/access-denied', function(){
    return view('pages.access_denied');
});
