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

Route::get('/', function () {
  $countries = country::all();
  $orders=order::where('duration','>',date('Y-m-d H:i:s'))->orderBy('id','desc')->paginate(4);
  return view('welcome',compact('countries','orders'));
});

Route::get('/logout', 'AuthController@logout')->name('logout');

Route::get('/twitter', function() {
  return Share::load('http://www.ecoopu.com', 'My description Here')->twitter();
});

Route::get('/facebook', function() {
  return Share::load('http://www.ecoopu.com', 'My description Here')->facebook();
});

Route::get('/test',function() {
  return view('emails.welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', function() {
	$countries = country::all();
	return view('auth.login', compact('countries'));
});

Route::get('/register', function() {
	$countries = country::all();
	return view('auth.register', compact('countries'));
});

Route::get('/contact-us', function(){
  $countries = country::all();
  return view('pages.contact-us', compact('countries'));
})->name('contact-us');

/*Route::get('/about-us', function(){
  $countries = country::all();
  return view('pages.about-us', compact('countries'));
})->name('about-us');*/

Route::get('/test_email', function(){
  $user = App\User::find(3);
  $token = '2034293412073042803';
  return view('auth.emails.password', compact('user', 'token'));
})->name('test_email');

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
|Pages routes
|
|
*/

Route::get('pages/create/order', 'OrderController@order')->name('order');

Route::post('pages/create/order', 'OrderController@create')->name('order');

Route::get('pages/orderlist/expired', 'OrderController@expired')->name('expired');

Route::get('pages/create/orderlist/{id}', 'OrderController@orderlist')->name('create_order');

Route::get('pages/create/orderlist/{id}/{status}', 'OrderController@paymentStatus')->name('payment_status');

Route::get('pages/create/orderlist/paymentStatusIPN', 'OrderController@paymentStatusIPN')->name('payment_status');

Route::post('pages/order/update_shipping_address', 'OrderController@updateShippingAddress')->name('update_shipping_address');

Route::post('pages/create/orderlist', 'OrderController@addItem')->name('create_order');

Route::get('itemremove/{id}','OrderController@removeItem');

Route::get('pages/market-places/{id}', 'OrderController@marketplace');

Route::get('removeorder/{id}','OrderController@removeorder');


/*
|
|
|Visitor Shop routes
|
|
*/

Route::get('shops_and_orderlists', 'ProductController@listShopsAndOrderlists')->name('list_shops_and_orderlists');
Route::get('shop/{id}', 'ProductController@listOrders')->name('shops_orders');


/*
|
|
|Shop routes
|
|
*/

Route::get('shop/index', 'ShopController@index')->name('shop_index');
Route::post('shop/index', 'ShopController@addprice')->name('shop_index');
Route::post('shop/index', 'ShopController@addshop')->name('addshop');

Route::get('shop/clients/{id}', 'ShopController@clients')->name('clients');

Route::get('shop/orderitems/user/{id}/order/{order_id}', 'ShopController@clientorderlist');

Route::post('shop/add/price', 'ShopController@addprice')->name('order_price');
