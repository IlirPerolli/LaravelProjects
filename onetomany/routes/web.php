<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Post;
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
    $user = User::findOrFail(1);
    $post = new Post(['title'=>'My first post with Edwin Diaz', 'body'=>'I love laravelz with Edwin Diaz']);
    //posts()->emri i funksionit ne modelin User
    $user->posts()->save($post);
});

Route::get('/read', function(){
    $user = User::findOrFail(1);
    foreach ($user->posts as $post){
       echo $post->title. "<br>";
    }
});
Route::get('/posts', function(){
    $posts = Post::all();
    foreach ($posts as $post){
        echo $post->title . "";
    }
});
Route::get('/update', function (){
    $user = User::find(1);
    //Kjo whereId tenton te ndryshoje rekordin me id 2 por tek postimet e mia
    $user->posts()->whereId(6)->update(['title'=>'I love laravel', 'body'=>'this is awesome']);
});
Route::get('/delete', function(){
   $user = User::find(1);
   $user->posts()->whereId(4)->delete();
});
