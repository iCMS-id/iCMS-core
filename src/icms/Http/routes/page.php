<?php 

Route::group(['prefix' => 'page'], function () {
	Route::get('/', ['as' => 'admin.page', 'uses' => 'PageController@index']);
});