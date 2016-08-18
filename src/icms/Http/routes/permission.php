<?php 

Route::get('permission/{role_id?}', ['uses' => 'PermissionController@index', 'as' => 'admin.permission']);
Route::post('permission/save/{role_id?}', ['uses' => 'PermissionController@save', 'as' => 'admin.permission.save']);
Route::get('permission/delete/{permission_id?}', ['uses' => 'PermissionController@delete', 'as' => 'admin.permission.delete']);
Route::post('permission/ajax', ['uses' => 'PermissionController@ajax', 'as' => 'admin.permission.ajax']);