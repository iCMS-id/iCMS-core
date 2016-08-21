<?php 

Route::get('/', ['as' => 'app.home', 'uses' => 'HomeController@index']);
Route::get('contact', ['as' => 'app.contact', 'uses' => 'HomeController@contact']);

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

Route::get('apps', ['uses' => 'HomeController@apps', 'as' => 'apps']);
