<?php 

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

Route::group(['middleware' => 'web.page'], function () {
	require 'routes/web.php';
});
