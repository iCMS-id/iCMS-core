<?php 

Route::group(['prefix' => 'notify'], function () {
	Route::get('/', ['as' => 'admin.notify', 'uses' => 'NotifyController@index']);
});