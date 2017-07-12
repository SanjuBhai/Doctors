<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
});

// Doctor related routes
Route::group(['middleware' => 'web', 'namespace' => 'Modules\User\Http\Controllers\Doctor', 'prefix' => 'doctor'], function()
{
	Route::get('register', 'RegisterController@index')->name('doctor.signup');
	Route::post('register', 'RegisterController@register');

	Route::get('{doctor}', 'DoctorController@details');
});

// Admin related routes
Route::group(['middleware' => 'web', 'namespace' => 'Modules\User\Http\Controllers\Admin', 'prefix' => 'admin'], function()
{
	Route::get('/', function(){
		return redirect()->route(Auth::check() ? 'admin.dashboard' : 'admin.login');
	});

	Route::get('login', 'LoginController@index')->name('admin.login');
	Route::post('login', 'LoginController@login');

	Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

	Route::get('settings', 'SettingController@index')->name('admin.settings');
	Route::post('settings', 'SettingController@store');

	Route::get('media', 'MediaController@index')->name('admin.media');

	Route::get('profile', 'ProfileController@index')->name('admin.profile');
	Route::post('profile', 'ProfileController@store');
	
	Route::get('change-password', 'PasswordController@index')->name('admin.change-password');
	Route::post('change-password', 'PasswordController@store');
	
	Route::get('seo', 'SEOController@index')->name('admin.seo');
	Route::post('seo', 'SEOController@store');

	Route::get('logout', 'LoginController@logout')->name('admin.logout');
});