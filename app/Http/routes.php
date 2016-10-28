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
Route::get('user/edit/account', 'SettingsAccount@index')->name('account');
Route::post('user/edit/account', 'SettingsAccount@update')->name('account');

Route::get('admin/add/new', 'AdminController@addAdmin')->name('addAdmin');
Route::post('admin/add/new', 'AdminController@register')->name('addAdmin');

Route::get('/admin/dashboard', 'AdminController@index')->name('admin');
