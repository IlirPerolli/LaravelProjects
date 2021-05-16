<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\Video;
use App\Tag;
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
   $post = Post::create(['name'=>'My first post']);
   $tag1 = Tag::find(1);
   $post->tags()->save($tag1);

   $video = Video::create(['name'=>'Video.mov']);
   $tag2 = Tag::find(2);
   $video->tags()->save($tag2);
});
//Bonus si ajo tek many-to-many me sync ose attach
Route::get('/create1', function (){
    $post = Post::find(1);
    $post->tags()->sync([3]);
});


Route::get('/read', function(){
    $post = Post::findOrFail(1);
    foreach ($post->tags as $tag){
        echo $tag;
    }

});

Route::get('/update', function(){
    $post = Post::findOrFail(1);
    foreach ($post->tags as $tag){
        $tag->whereName('PHP')->update(['name'=>'UpdatedPHP']);
    }
});
Route::get('/update1', function(){
    $post = Post::findOrFail(1);
   $tag = Tag::find(3);
   $post->tags()->save($tag);
   //$post->tags()->attach($tag);
   //$post->tags()->sync([1,2]);
});
Route::get('delete', function(){
    $post = Post::find(1);
    foreach ($post->tags as $tag){
        $tag->whereId(1)->delete();
    }
});
