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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['middleware' => ['api']], function () {
    Route::resource('/customer', 'CustomerController', [
        'except' => ['create', 'edit']
    ]);
    /*
    Route::resource('/invoice', 'InvoiceController', [
        'except' => ['create', 'edit']
    ]);
*/
    Route::get('/invoice/test', 'InvoiceController@test');

    Route::resource('/invoice-item', 'InvoiceItemController', [
        'except' => ['create', 'edit']
    ]);
});
