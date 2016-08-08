<?php 

Route::group(['prefix' => 'post'], function () {
	Route::get('/', ['as' => 'admin.post', 'uses' => 'PostController@index']);
});