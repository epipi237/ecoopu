
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


Route::group(['middleware' => ['web']], function () {

    // Welcome route
    Route::get('/', 'WelcomeController@index')->name('welcome');
    route::get('error','ErrorController@defaultError')->name('error');


    Route::auth();
    Route::get('/home', 'HomeController@index');

    // Login Routes...
    Route::get('/admin/login','AdminAuth\AdminAuthController@showLoginForm');
    Route::post('/admin/login','AdminAuth\AdminAuthController@login');
    Route::get('/admin/logout','AdminAuth\AdminAuthController@logout');

    // Registration Routes...
    Route::get('admin/register', 'AdminAuth\AdminAuthController@showRegistrationForm');
    Route::post('admin/register', 'AdminAuth\AdminAuthController@register');

    Route::post('admin/password/email','AdminAuth\AdminPasswordController@sendResetLinkEmail');
    Route::post('admin/password/reset','AdminAuth\AdminPasswordController@reset');
    Route::get('admin/password/reset/{token?}','AdminAuth\AdminPasswordController@showResetForm');

    Route::get('/admin', 'AdminController@index');
}); 