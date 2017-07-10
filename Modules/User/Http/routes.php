<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
});

// Doctor related routes
Route::group(['middleware' => 'web', 'namespace' => 'Modules\User\Http\Controllers\Doctor', 'prefix' => 'doctor'], function(){
	Route::get('signup', 'DoctorController@signup')->name('doctor-signup');
	Route::get('{doctor}', 'DoctorController@details');
});

// Admin related routes
Route::group(['middleware' => 'web', 'namespace' => 'Modules\User\Http\Controllers\Admin', 'prefix' => 'admin'], function(){
	Route::get('login', 'AdminController@login')->name('admin-login');
	Route::get('dashboard', 'DashboardController@index')->name('admin-dashboard');
	Route::get('seo', 'SEOController@index')->name('admin-seo');
});