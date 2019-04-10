<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::get('/stoas', 'StoaController@index')->name('stoa.get-all');
Route::get('/stoas/{stoa}', 'StoaController@show')->name('stoa.get');
Route::post('/stoas', 'StoaController@create')->name('stoa.post');
Route::put('/stoas/{stoa}', 'StoaController@update')->name('stoa.put');
Route::delete('/stoas/{stoa}', 'StoaController@delete')->name('stoa.delete');

Route::post('/schedules/import', 'ScheduleController@import')->name('schedule.import');
Route::post('/schedules/{stoa}', 'ScheduleController@setSchedule')->name('schedule.set-schedule');
Route::delete('/schedules/{stoa}', 'ScheduleController@deleteSchedule')->name('schedule.delete');
