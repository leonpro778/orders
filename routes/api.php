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


Route::group(['middleware' => ['authApi']], function () {
    Route::get('orders/last', 'Auth\APIController@getOrdersLast');
});


Route::post('login', 'Auth\APICOntroller@login');
Route::post('checkStatus', 'Auth\APIController@checkStatus');
