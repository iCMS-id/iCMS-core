<?php 

Route::group(['middleware' => 'guest'], function () {
	Route::get('login', ['as' => 'app.login', 'uses' => 'AuthController@login']);
	Route::post('login', ['as' => 'app.login.post', 'uses' => 'AuthController@postLogin']);
	Route::get('register', ['as' => 'app.register', 'uses' => 'AuthController@register']);
	Route::post('register', ['as' => 'app.register.post', 'uses' => 'AuthController@postRegister']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('logout', ['as' => 'app.logout', 'uses' => 'AuthController@logout']);
	Route::get('profile', ['as' => 'app.profile', 'uses' => 'AuthController@profile']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
	Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin.home']);
	Route::get('posts', ['uses' => 'PostController@index', 'as' => 'admin.posts']);

	require 'routes/page.php';
	require 'routes/post.php';
	require 'routes/event.php';
	require 'routes/media.php';
	require 'routes/apps.php';
	require 'routes/users.php';
	require 'routes/role.php';
	require 'routes/permission.php';
	require 'routes/notification.php';

	Route::get('apps', ['uses' => 'AppController@index', 'as' => 'admin.apps']);
});

require 'routes/web.php';
Route::get('apps', ['uses' => 'HomeController@apps', 'as' => 'apps']);