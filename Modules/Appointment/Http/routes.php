<?php

Route::group(['middleware' => 'web', 'prefix' => 'appointment', 'namespace' => 'Modules\Appointment\Http\Controllers'], function()
{
    Route::get('/', 'AppointmentController@index');
    Route::get('book/{doctor}', 'AppointmentController@create')->name('book-appointment');
    Route::post('book', 'AppointmentController@store');
});
