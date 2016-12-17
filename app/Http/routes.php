<?php

use App\Order;
use App\country;

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

Route::get('/', function (){
	$countries = country::all();
	$orders=order::where('duration','>',date('Y-m-d H:i:s'))->orderBy('id','desc')->paginate(4);
	return view('welcome',compact('countries','orders'));
});

Route::get('/twitter', function()
{
  return Share::load('http://www.ecoopu.com', 'My description Here')->twitter();
});

Route::get('/facebook', function()
{
  return Share::load('http://www.ecoopu.com', 'My description Here')->facebook();
});

Route::get('/test',function(){
  return view('emails.welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', function () {
	$countries = country::all();
	return view('auth.login',compact('countries'));
});

Route::get('/register', function () {
	$countries = country::all();
	return view('auth.register',compact('countries'));
});

Route::get('user/edit/account','SettingsAccount@index')->name('account');
Route::post('user/edit/account','SettingsAccount@update')->name('account');

Route::get('admin/add/new','AdminController@addAdmin')->name('addAdmin');
Route::post('admin/add/new','AdminController@register')->name('addAdmin');

Route::get('/admin/add/market-places','AdminController@getMarket')->name('market');
Route::post('/admin/add/market-places','AdminController@addMarket')->name('market');

Route::get('marketplaceremove/{id}','AdminController@removemarket');

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

  Route::get('pages/orderlist/expired', 'OrderController@expired')->name('expired');

  Route::get('pages/create/orderlist/{id}', 'OrderController@orderlist')->name('create_order');
  Route::post('pages/create/orderlist', 'OrderController@createOrderList')->name('create_order');
  Route::get('itemremove/{id}','OrderController@removeitem');
  Route::get('pages/market-places/{id}', 'OrderController@marketplace');

  Route::get('removeorder/{id}','OrderController@removeorder');

  /*
  |
  |
  |Shop  route
  |
  |
  */

  Route::get('shop/index', 'ShopController@index')->name('shop_index');
  Route::post('shop/index', 'ShopController@addprice')->name('shop_index');
  Route::post('shop/index', 'ShopController@addshop')->name('addshop');

  Route::get('shop/clients/{id}', 'ShopController@clients')->name('clients');

  Route::get('shop/orderitems/user/{id}/order/{order_id}', 'ShopController@clientorderlist');

  Route::post('shop/add/price', 'ShopController@addprice')->name('order_price');


  /*
  |
  |
  |Paypal Payment  route
  |
  |
  */

Route::get('/payment_paypal', 'PaypalController@prepare_paypal');
Route::get('/payment_prepare/{id?}', 'PaypalController@payment_prepare');
Route::get('/payment_authorize', 'PaypalController@prepare_authorize');
Route::get('/payment_offline', 'PaypalController@prepare_offline');

Route::get('/authorize_payment_done', ['as'=>'authorize_payment_done', 'uses'=>'PaypalController@authorize_done']);

Route::get('/paypal_payment_done', ['as'=>'paypal_payment_done', 'uses'=>'PaypalController@paypal_done']);

Route::get('/offline_payment_done', ['as'=>'offline_payment_done', 'uses'=>'PaypalController@offline_done']);

