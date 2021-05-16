<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Role;
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

Route::get('/create', function(){
    $user = User::find(1);
    $role = new Role(['name'=>'Administrator']);
    $user->roles()->save($role);
});
Route::get('/read', function (){
    $user = User::findOrFail(1);
    foreach ($user->roles as $role){
        echo $role->name;
    }
});

Route::get('/update', function(){
    $user = User::findOrFail(1);
   if ($user->has('roles')) {
       foreach ($user->roles as $role){
        if ($role->name == 'Administrator'){
            $role->name = "administrator";
            $role->save();
        }
       }
   }

});

Route::get('/delete', function (){

    $user = User::findOrFail(1);
    foreach ($user->roles as $role){
        $role->whereId(3)->delete();
    }
});

Route::get('/attach', function(){
   $user = User::findOrFail(1);
   //Id nr 4 e roles dmth userin ja japim rolin 4
   $user->roles()->attach(4);
});

Route::get('/detach', function(){
    $user = User::findOrFail(1);
    //Id nr 4 e roles dmth userin e hekim nga id 4
    $user->roles()->detach(4);
});

Route::get('/sync', function(){
   $user = User::findOrFail(1);
   //Sync e merr p.sh id e rolit 1 dhe 4 dhe i inserton per ate user dhe nese ekzistojin tjera kjo i fshin.
   $user->roles()->sync([1,4]);
});
