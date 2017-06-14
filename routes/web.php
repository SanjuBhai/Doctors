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

// Home page
Route::get('/', 'HomeController@index');

// Doctor related routes
Route::group(['namespace' => 'Doctor', 'prefix' => 'doctor'], function(){
	Route::get('signup', 'DoctorController@signup')->name('doctor-signup');
});

// Admin related routes
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
	
});

// Ajax Routes
Route::group(['prefix' => 'api'], function(){
	Route::post('get-cities', 'ApiController@getCities');
	Route::post('get-localities', 'ApiController@getLocalities');
	Route::post('get-data', 'ApiController@getData');
});

Route::match(['get', 'post'], 'search', 'SearchController@search')->name('search');
Route::get('doctor/{slug}', 'Doctor\DoctorController@details');

// Show 404 page in case of incorrect url
Route::any('{all}', function(){
    return view('errors.404');
})->where('all', '.*');