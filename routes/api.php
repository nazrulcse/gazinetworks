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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::group(['prefix' => '/v1'], function(){
    Route::post('login', 'API\v1\UserController@login');
    Route::post('register', 'API\v1\UserController@register');
    Route::post('/invoice/store', 'API\v1\InvoiceController@store');
    Route::get('/invoice/customer_invoices', 'API\v1\InvoiceController@customer_invoices');
    Route::get('payments', 'API\v1\PaymentController@index');
    Route::post('payment/store', 'API\v1\PaymentController@store');
    Route::post('payment/{}', 'API\v1\PaymentController@store');
    Route::post('contacts/store', 'API\v1\ContactController@store');
    Route::post('complain/store', 'API\v1\ComplainController@store');

});

Route::group(['prefix' => '/v1','middleware' => 'auth:api'], function(){
    Route::post('profile', 'API\v1\UserController@profile');
    Route::post('details', 'API\v1\UserController@details');

});
