<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Address;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/insert', function(){
    $user = User::findOrFail(1);
    $address = new Address(['name'=>'1234 Houston Av NY NY 11218']);
    //address()->emri i funksionit ne modelin User
    $user->address()->save($address);
});

Route::get('/update', function(){

    $address = Address::where('user_id', 1)->first();
    $address->name="4353 Update AV, alaska";
    $address->save();
});
Route::get('/read', function(){
    $user = User::findOrFail(1);
    return $user->address->name;
});
Route::get('/delete', function(){
    $user = User::findOrFail(1);
        $user->address()->delete();

});