<?php 

Route::group(['prefix' => 'event'], function () {
	Route::get('/', ['as' => 'admin.event', 'uses' => 'EventController@index']);
	Route::get('upcomming', ['as' => 'admin.event.upcomming', 'uses' => 'EventController@comming']);
	Route::post('ajax', ['as' => 'admin.event.ajax', 'uses' => 'EventController@ajax']);
});