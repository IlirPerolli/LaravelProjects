<?php

Route::get('/permissions', 'PermissionController@index')->name('permissions.index');
Route::post('/permissions', 'PermissionController@store')->name('permissions.store');
Route::get('/permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
Route::delete('/permissions/{permission}/destroy', 'PermissionController@destroy')->name('permissions.destroy');
Route::put('/permissions/{permission}/update','PermissionController@update')->name('permissions.update');


//Ktu nuk kemi nevoje per middleware sepse e kemi deklaruar tek RouteServiceProvider

