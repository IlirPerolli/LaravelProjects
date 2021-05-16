<?php
//Duhet te bejme ndryshime ne RouteServiceProvider
use Illuminate\Support\Facades\Route;
Route::put('/users/{user}/update','UserController@update')->name('user.profile.update');
Route::delete('/users{user}/destroy', 'UserController@destroy')->name('users.destroy');

Route::middleware(['role:admin', 'auth'])->group(function(){
    //e bejme role:Admin ku me : ja japim parametrin e rolit
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::put('/users/{user}/attach', 'UserController@attach')->name('user.role.attach');
    Route::put('/users/{user}/detach', 'UserController@detach')->name('user.role.detach');

});
Route::middleware('can:view,user')->group(function(){
    Route::get('/users/{user}/profile','UserController@show')->name('user.profile.show');

});
