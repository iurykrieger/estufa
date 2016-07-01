<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Scan;
use App\Sensor;
use App\Charts;


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

Route::get('adminlte', function(){
	return view('layouts.adminlte');
});

Route::get('admin', 'DashboardController@index');

Route::get('/',function(){
	return Redirect::to('/admin');
});

/**
 * Sensor Routes
 */
Route::delete('/admin/sensor/multipleDestroy','SensorController@multipleDestroy');
Route::get('/admin/sensor/{sensor}/deactivate','SensorController@deactivate');
Route::get('/admin/sensor/{sensor}/activate','SensorController@activate');
Route::get('/admin/sensor/ambient/{ambient?}','SensorController@getSensorsByAmbient');
Route::resource('/admin/sensor', 'SensorController');

/**
 * Scan Routes
 */
Route::get('/admin/scan/sensor/{sensor?}', 'ScanController@indexBySensor');
Route::get('/admin/scan/ambient/{ambient?}', 'ScanController@indexByAmbient');
Route::post('/admin/scan/date', 'ScanController@getScansByDates');
Route::get('/admin/scan/all', 'ScanController@indexAll');
Route::resource('/admin/scan', 'ScanController',['only' => ['index', 'show', 'destroy']]);

/**
 * Ambient Routes
 */
Route::post('/admin/ambient/sensors/{ambient}','AmbientController@deactivateAmbientSensors');
Route::resource('/admin/ambient', 'AmbientController');

/**
 * Authentication Routes
 */
Route::get('/admin/auth/login', 'Auth\AuthController@getLogin');
Route::post('/admin/auth/login', 'Auth\AuthController@postLogin');
Route::get('/admin/auth/logout', 'Auth\AuthController@getLogout');

/**
 * Registration Routes
 */
Route::get('/admin/auth/register', 'Auth\AuthController@getRegister');
Route::post('/admin/auth/register', 'Auth\AuthController@postRegister');

/**
 * Password reset link request routes
 */
Route::get('/admin/password/email', 'Auth\PasswordController@getEmail');
Route::post('/admin/password/email', 'Auth\PasswordController@postEmail');

/**
 * Password reset routes
 */
Route::get('/admin/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('/admin/password/reset', 'Auth\PasswordController@postReset');

/**
 * Charts reset routes
*/
Route::get('/admin/chart/scans','ChartController@index');
Route::post('/admin/chart/scans','ChartController@postChart');


/**
 * Report Routes
 */
Route::get('/admin/report/scan', ['uses' =>'ReportController@indexScan']);
Route::post('/admin/report/scan', ['uses' =>'ReportController@postScan']);
 

