<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin'], function(){
	// Route::resource('/customer', 'CustomerController');
	Route::resource('/product', 'Master\ProductController');
	Route::resource('/order','Transaction\OrderController');
	Route::get('/order/codegen/{date}','Transaction\OrderController@codegen');
	Route::get('/order/prodname/{id}','Transaction\OrderController@prodname');

	Route::resource('monitoring-order','Transaction\MonitoringOrderController');
	Route::get('monitoring-order/detail/{id}','Transaction\MonitoringOrderController@detail')->name('monitoring-order.detail');;
	// Route::resource('/calculator','CalculatorController');
	Route::resource('/user','UserController');
});
