<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('user/edit/account','SettingsAccount@index')->name('account');
Route::post('user/edit/account','SettingsAccount@update')->name('account');

Route::get('admin/add/new','AdminController@addAdmin')->name('addAdmin');
Route::post('admin/add/new','AdminController@register')->name('addAdmin');

Route::get('/admin/add/market-places','AdminController@getMarket')->name('market');
Route::post('/admin/add/market-places','AdminController@addMarket')->name('market');

Route::get('/admin/dashboard', 'AdminController@index')->name('admin');
  /*
  |
  |
  |Pages route
  |
  |
  */

  Route::get('pages/create/order', 'OrderController@order')->name('order');
  Route::post('pages/create/order', 'OrderController@create')->name('order');
  Route::get('pages/create/orderlist/{id}', 'OrderController@orderlist')->name('create_order');
  Route::post('pages/create/orderlist', 'OrderController@createOrderList')->name('create_order');
Route::get('itemremove/{id}','OrderController@removeitem');

