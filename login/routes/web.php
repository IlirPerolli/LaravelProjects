<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    //Per te kontrolluar se nese eshte perdoruesi i kyqur
//    if(Auth::check()){
//      return "The user is logged in";
//    }

//        if (Auth::attempt(['username'=>$username, 'password'=>'password'])){
//            //Intended eshte p.sh kur deshiron me shku n admin e ridirektohet n login ather kur t kyqet me shku n admin
//            return redirect()->intended();
//
//        }
//    Auth::logout();

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
