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

// Dashboard
Route::get('/dashboard', 'DashboardController@index');

// Registration Module
Route::get('/staff', 'MasterfileController@index');
Route::post('/save-staff', 'MasterfileController@store');
Route::get('/client', 'MasterfileController@client');
Route::post('/update-masterfile', 'MasterfileController@update');
Route::delete('/delete-masterfile', 'MasterfileController@destroy');
Route::get('/all-masterfiles', 'MasterfileController@allMfs');
Route::get('/all-teachers', 'MasterfileController@allTeachers');
Route::get('/all-guardians', 'MasterfileController@allGuardians');
Route::get('/all-students', 'MasterfileController@allStudents');
Route::get('/all-ss', 'MasterfileController@allSS');
Route::resource('contact_types','ContactTypesController');
Route::resource('streams','StreamsController');

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

Auth::routes();

Route::get('/home', 'HomeController@index');

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
Route::get('/theme-config', 'ThemeController@index');
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
Route::delete('/delete-user-role/{id}','UserManagerController@destroyRole');
Route::get('/audit_trails','UserManagerController@auditTrails');
Route::get('/ajax_trails','UserManagerController@ajaxAuditTrails');