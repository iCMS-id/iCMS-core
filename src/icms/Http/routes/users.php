<?php 

Route::group(['prefix' => 'users'], function () {
	Route::get('/', ['uses' => 'UsersController@index', 'as' => 'admin.users']);
	Route::get('add', ['uses' => 'UsersController@add', 'as' => 'admin.users.add']);
	Route::post('add', ['uses' => 'UsersController@save', 'as' => 'admin.users.save']);
	Route::post('ajax', ['uses' => 'UsersController@ajax', 'as' => 'admin.users.ajax']);
	Route::get('edit/{id?}', ['uses' => 'UsersController@edit', 'as' => 'admin.users.edit']);
	Route::post('edit/{id?}', ['uses' => 'UsersController@update', 'as' => 'admin.users.update']);
	Route::get('delete/{id?}', ['uses' => 'UsersController@delete', 'as' => 'admin.users.delete']);
});
