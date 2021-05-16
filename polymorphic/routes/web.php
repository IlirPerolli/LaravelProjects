<?php

use Illuminate\Support\Facades\Route;
use App\Staff;
use App\Photo;
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
    $staff = Staff::find(1);
    $staff->photos()->create(['path'=>'example.jpg']);
    //Si me heret
//    $role = new Photo(['path'=>'examplee.jpgg']);
//    $staff->photos()->save($role);
});
Route::get('/read', function(){
    $staff = Staff::findOrFail(1);
    foreach ($staff->photos as $photo)
    {echo $photo->path;}
});
Route::get('/update', function (){
   $staff = Staff::findOrFail(1);
   $photo = $staff->photos()->whereId(1)->first();
   $photo->path="Update example.jpg";
   $photo->save();
});
Route::get('/delete', function(){
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(1)->delete();
});
//Pakashum si updati
Route::get('/assign', function(){
    $staff = Staff::findOrFail(1);
   $photo = Photo::findOrFail(9);
   $staff->photos()->save($photo);
});
Route::get('/un-assign', function (){
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(9)->update(['imageable_id'=>'', 'imageable_type'=>'']);
});
