<?php

Route::group(['middleware' => 'web', 'prefix' => 'qa', 'namespace' => 'Modules\QA\Http\Controllers'], function()
{
    Route::get('/', 'QAController@index');
});
