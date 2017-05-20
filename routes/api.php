<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/first-applications', 'FirstApplicationsController@store');
Route::group(['middleware' => ['web']], function (){
    Route::get('/verify/email/{user_id}/{token}', 'Auth\RegisterController@verify');
});
Route::get('/credit-wallet/{client_account_id}', 'WalletController@creditWallet');
Route::any('/credit-wallet', 'WalletController@creditWallet');