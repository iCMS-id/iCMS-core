<?php 

Route::get('/', ['as' => 'app.home', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'admin'], function () {
	Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin.home']);

	Route::get('posts', ['uses' => 'PostController@index', 'as' => 'admin.posts']);

	Route::get('apps', ['uses' => 'AppController@index', 'as' => 'admin.apps']);
});

Route::get('apps', ['uses' => 'HomeController@apps', 'as' => 'apps']);