<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
});

// Doctor related routes
Route::group(['middleware' => 'web', 'namespace' => 'Modules\User\Http\Controllers\Doctor', 'prefix' => 'doctor'], function()
{
	Route::get('/', function(){
		return redirect()->route(Auth::check() ? 'doctor.dashboard' : 'login');
	});

	Route::get('dashboard', 'DashboardController@index')->name('doctor.dashboard');

	Route::get('register', 'RegisterController@index')->name('doctor.signup');
	Route::post('register', 'RegisterController@register');
	Route::get('register/completed', 'RegisterController@thanks')->name('doctor.signup.completed');

	Route::get('profile', 'ProfileController@index')->name('doctor.profile');
	Route::post('profile', 'ProfileController@store');
	
	Route::get('change-password', 'PasswordController@index')->name('doctor.change-password');
	Route::post('change-password', 'PasswordController@store');

	Route::get('educations', 'EducationController@index')->name('doctor.educations');
	Route::get('educations/add', 'EducationController@create')->name('doctor.educations.add');
	Route::post('educations/add', 'EducationController@store');
	Route::get('educations/edit/{id}', 'EducationController@edit')->name('doctor.educations.edit');
	Route::post('educations/edit/{id}', 'EducationController@update');
	Route::post('educations/delete', 'EducationController@delete')->name('doctor.educations.delete');

	Route::get('videos', 'VideoController@index')->name('doctor.videos');
	Route::get('videos/add', 'VideoController@create')->name('doctor.videos.add');
	Route::post('videos/add', 'VideoController@store');
	Route::get('videos/edit/{id}', 'VideoController@edit')->name('doctor.videos.edit');
	Route::post('videos/edit/{id}', 'VideoController@update');
	Route::post('videos/delete', 'VideoController@delete')->name('doctor.videos.delete');

	Route::get('appointments', 'AppointmentController@index')->name('doctor.appointments');
	Route::get('appointments/add', 'AppointmentController@create')->name('doctor.appointments.add');
	Route::post('appointments/add', 'AppointmentController@store');
	Route::get('appointments/edit/{id}', 'AppointmentController@edit')->name('doctor.appointments.edit');
	Route::post('appointments/edit/{id}', 'AppointmentController@update');
	Route::post('appointments/delete', 'AppointmentController@delete')->name('doctor.appointments.delete');

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
	
	Route::get('users', 'UserController@index')->name('admin.users');
	Route::get('users/add', 'UserController@create')->name('admin.users.add');
	Route::post('users/add', 'UserController@store');
	Route::get('users/edit/{user_id}', 'UserController@edit')->name('admin.users.edit');
	Route::post('users/edit/{user_id}', 'UserController@update');
	Route::get('users/view/{user_id}', 'UserController@show')->name('admin.users.view');
	Route::post('users/delete', 'UserController@delete')->name('admin.users.delete');

	Route::get('media', 'MediaController@index')->name('admin.media');

	Route::get('profile', 'ProfileController@index')->name('admin.profile');
	Route::post('profile', 'ProfileController@store');
	
	Route::get('change-password', 'PasswordController@index')->name('admin.change-password');
	Route::post('change-password', 'PasswordController@store');
	
	Route::get('seo', 'SEOController@index')->name('admin.seo');
	Route::post('seo', 'SEOController@store');

	Route::get('logout', 'LoginController@logout')->name('admin.logout');

	/* Custom routes */
	Route::get('doctors', 'DoctorController@index')->name('admin.doctors');
	Route::get('doctors/view/{user_id}', 'DoctorController@show')->name('admin.doctors.view');
});