<?php 

Route::get('/', ['as' => 'app.home', 'uses' => 'HomeController@index']);
Route::get('contact', ['as' => 'app.contact', 'uses' => 'HomeController@contact']);