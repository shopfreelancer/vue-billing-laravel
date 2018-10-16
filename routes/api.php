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


Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResource('/customer', 'CustomerController');

    Route::get('/invoice/generate-pdf/{id}', 'InvoiceController@generatePdf');
    Route::resource('/invoice', 'InvoiceController', [
        'except' => ['create', 'edit']
    ]);

    Route::resource('/invoice-item', 'InvoiceItemController', [
        'except' => ['create', 'edit']
    ]);

    Route::resource('/ticket', 'TicketController', [
        'except' => ['create', 'edit']
    ]);

    Route::get('/logout','Auth2Controller@logout')->name('logout');


});

Route::post('/login','Auth2Controller@login')->name('login');


Route::options('{any?}', function () {
    return response('', 200);
})->where('any', '.*');
