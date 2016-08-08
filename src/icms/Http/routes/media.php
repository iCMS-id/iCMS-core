<?php 

Route::group(['prefix' => 'media'], function () {
	Route::get('/', ['as' => 'admin.media', 'uses' => 'MediaController@index']);
});