<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Scan;
use App\Sensor;


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

/**
 * Dashboard Routes
 */
Route::get('/admin', 'DashboardController@index');

Route::get('/',function(){
	return Redirect::to('/admin');
});

/**
 * Scan Routes
 */
Route::get('/admin/scans/sensor/{sensor?}','ScanController@showBySensor');

Route::get('/admin/scans/ambient/{ambient?}','ScanController@showByAmbient');

Route::get('/admin/scans/{pagesize?}', 'ScanController@index');

/**
 * Sensor Routes
 */
Route::resource('admin/sensor/', 'SensorController');

/**
 * Authentication Routes
 */
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

/**
 * Registration Routes
 */
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/**
 * Password reset link request routes
 */
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

/**
 * Password reset routes
 */
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');