<?php 

Route::group(['prefix' => 'post'], function () {
	Route::get('/', ['as' => 'admin.post', 'uses' => 'PostController@index']);
	Route::post('ajax', ['as' => 'admin.post.ajax', 'uses' => 'PostController@ajax']);
});
