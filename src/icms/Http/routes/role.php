<?php 

Route::get('role/add', ['uses' => 'RolesController@add', 'as' => 'admin.role.add']);
Route::post('role/add', ['uses' => 'RolesController@save', 'as' => 'admin.role.save']);
Route::post('role/ajax', ['uses' => 'RolesController@ajax', 'as' => 'admin.role.ajax']);
Route::get('role/edit/{id?}', ['uses' => 'RolesController@edit', 'as' => 'admin.role.edit']);
Route::post('role/edit/{id?}', ['uses' => 'RolesController@update', 'as' => 'admin.role.update']);
Route::get('role/delete/{id?}', ['uses' => 'RolesController@delete', 'as' => 'admin.role.delete']);