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

Route::group(['middleware' => ['cors']], function () {
	Route::group(['middleware' => ['authApi']], function () {
		Route::get('orders/{fromDate}/{toDate}', 'Auth\APIController@getOrders');
	});

	Route::post('logout', 'Auth\APIController@logout');
	Route::post('login', 'Auth\APIController@login');
	Route::post('checkStatus', 'Auth\APIController@checkStatus');
});
