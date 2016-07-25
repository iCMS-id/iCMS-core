<?php 

Route::get('/', ['as' => 'app.home', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'admin'], function () {
	Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin.home']);
	Route::get('home/{address}', function ($address) {
		return $address;
	});

	Route::any('apps/{path}', ['as' => 'admin.apps', 'uses' => 'PackageController@admin'])->where('path', '(.*)');;
});

Route::any('apps/{path}', ['as' => 'apps', 'uses' => 'PackageController@handle'])->where('path', '(.*)');
