<?php 

Route::group(['prefix' => 'page'], function () {
	Route::get('/', ['as' => 'admin.page', 'uses' => 'PageController@index']);
	Route::post('/', ['as' => 'admin.page.save', 'uses' => 'PageController@save']);
	Route::post('ajax', ['as' => 'admin.page.ajax', 'uses' => 'PageController@ajax']);
	Route::post('move', ['as' => 'admin.page.move', 'uses' => 'PageController@move']);
	Route::post('delete', ['as' => 'admin.page.delete', 'uses' => 'PageController@delete']);
});
