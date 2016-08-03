<?php 

Route::get('/', ['as' => 'app.home', 'uses' => 'HomeController@index']);

Route::group(['middleware' => 'guest'], function () {
	Route::get('login', ['as' => 'app.login', 'uses' => 'AuthController@login']);
	Route::post('login', ['as' => 'app.login.post', 'uses' => 'AuthController@postLogin']);
	Route::get('register', ['as' => 'app.register', 'uses' => 'AuthController@register']);
	Route::post('register', ['as' => 'app.register.post', 'uses' => 'AuthController@postRegister']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
	Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin.home']);
	Route::get('posts', ['uses' => 'PostController@index', 'as' => 'admin.posts']);

	Route::get('users', ['uses' => 'UsersController@index', 'as' => 'admin.users']);
	Route::get('users/add', ['uses' => 'UsersController@add', 'as' => 'admin.users.add']);
	Route::post('users/add', ['uses' => 'UsersController@save', 'as' => 'admin.users.save']);
	Route::post('users/ajax', ['uses' => 'UsersController@ajax', 'as' => 'admin.users.ajax']);
	Route::get('users/edit/{id?}', ['uses' => 'UsersController@edit', 'as' => 'admin.users.edit']);
	Route::get('users/delete/{id?}', ['uses' => 'UsersController@delete', 'as' => 'admin.users.delete']);

	Route::get('role/add', ['uses' => 'RolesController@add', 'as' => 'admin.users.role.add']);
	Route::get('apps', ['uses' => 'AppController@index', 'as' => 'admin.apps']);
});

Route::get('apps', ['uses' => 'HomeController@apps', 'as' => 'apps']);