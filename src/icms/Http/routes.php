<?php 

Route::get('/', ['as' => 'app.home', 'uses' => 'HomeController@index']);

Route::group(['middleware' => 'guest'], function () {
	Route::get('login', ['as' => 'app.login', 'uses' => 'AuthController@login']);
	Route::post('login', ['as' => 'app.login.post', 'uses' => 'AuthController@postLogin']);
	Route::get('register', ['as' => 'app.register', 'uses' => 'AuthController@register']);
	Route::post('register', ['as' => 'app.register.post', 'uses' => 'AuthController@postRegister']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('logout', ['as' => 'app.logout', 'uses' => 'AuthController@logout']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
	Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin.home']);
	Route::get('posts', ['uses' => 'PostController@index', 'as' => 'admin.posts']);

	Route::get('users', ['uses' => 'UsersController@index', 'as' => 'admin.users']);
	Route::get('users/add', ['uses' => 'UsersController@add', 'as' => 'admin.users.add']);
	Route::post('users/add', ['uses' => 'UsersController@save', 'as' => 'admin.users.save']);
	Route::post('users/ajax', ['uses' => 'UsersController@ajax', 'as' => 'admin.users.ajax']);
	Route::get('users/edit/{id?}', ['uses' => 'UsersController@edit', 'as' => 'admin.users.edit']);
	Route::post('users/edit/{id?}', ['uses' => 'UsersController@update', 'as' => 'admin.users.update']);
	Route::get('users/delete/{id?}', ['uses' => 'UsersController@delete', 'as' => 'admin.users.delete']);

	Route::get('role/add', ['uses' => 'RolesController@add', 'as' => 'admin.role.add']);
	Route::post('role/add', ['uses' => 'RolesController@save', 'as' => 'admin.role.save']);
	Route::post('role/ajax', ['uses' => 'RolesController@ajax', 'as' => 'admin.role.ajax']);
	Route::get('role/edit/{id?}', ['uses' => 'RolesController@edit', 'as' => 'admin.role.edit']);
	Route::post('role/edit/{id?}', ['uses' => 'RolesController@update', 'as' => 'admin.role.update']);
	Route::get('role/delete/{id?}', ['uses' => 'RolesController@delete', 'as' => 'admin.role.delete']);

	Route::get('permission/{role_id?}', ['uses' => 'PermissionController@index', 'as' => 'admin.permission']);
	Route::post('permission/save/{role_id?}', ['uses' => 'PermissionController@save', 'as' => 'admin.permission.save']);
	Route::get('permission/delete/{permission_id}', ['uses' => 'PermissionController@delete', 'as' => 'admin.permission.delete']);

	Route::get('apps', ['uses' => 'AppController@index', 'as' => 'admin.apps']);
});

Route::get('apps', ['uses' => 'HomeController@apps', 'as' => 'apps']);