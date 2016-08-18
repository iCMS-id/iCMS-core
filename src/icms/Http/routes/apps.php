<?php 

Route::post('apps/ajax', ['as' => 'admin.apps.ajax', 'uses' => 'AppController@ajax']);