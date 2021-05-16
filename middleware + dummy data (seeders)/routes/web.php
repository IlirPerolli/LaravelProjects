<?php

use App\User;
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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Aplikojme middlerawen role ne kete url gjithashtu middlewaren duhet ta regjistrojme ne kernel.php
Route::get('/admin/user/roles',['middleware'=>'role', function(){
    return "Middleware Role";
}]);

Route::get('/user',function(){
  $user = Auth::user();
  if($user->isAdmin()){
      echo "This user is a admin";
  }
  else{
      echo "This user is not a admin";
  }
});

