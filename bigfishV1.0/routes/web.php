<?php

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
    return view('index');
});
Route::get('about', function(){
    return view('about');
})->name('about');

Auth::routes();


Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::middleware('auth')->group(function(){
    Route::get('/posts/create', 'App\Http\Controllers\PostsController@create_multiple')->name('post.create.multiple');
    Route::post('/posts/create','App\Http\Controllers\PostsController@store_multiple')->name('post.store.multiple');
    Route::get('/posts/creates', function (){
       return view('posts.create1');
    });
    Route::post('/posts/creates','App\Http\Controllers\PostsController@store_multiple1')->name('post.store.multiple1');
    Route::get('/post/create','App\Http\Controllers\PostsController@create')->name('post.create');
    Route::post('post','App\Http\Controllers\PostsController@store')->name('post.store');
    Route::delete('/post/{post}','App\Http\Controllers\PostsController@destroy')->name('post.destroy');
    Route::put('/post/{post}','App\Http\Controllers\PostsController@update')->name('post.update');
    Route::get('/post/{post}/edit','App\Http\Controllers\PostsController@edit')->name('post.edit');

    Route::get('/user/{user}/edit','App\Http\Controllers\UserProfileController@edit')->name('user.edit');
    Route::patch('/user/{user}','App\Http\Controllers\UserProfileController@update')->name('user.update');
    Route::get('/user/changePassword', 'App\Http\Controllers\UserChangePasswordController@index')->name('user.password.edit');
    Route::patch('/user/changePassword/update', 'App\Http\Controllers\UserChangePasswordController@update')->name('user.password.update');
    Route::get('/user/changePhoto', 'App\Http\Controllers\UserChangePhotoController@index')->name('user.photo.edit');
    Route::patch('/user/changePhoto/update', 'App\Http\Controllers\UserChangePhotoController@update')->name('user.photo.update');
    Route::patch('/user/changePhoto/destroy', 'App\Http\Controllers\UserChangePhotoController@destroy')->name('user.photo.destroy');

    Route::post('profile/{user}/follow', 'App\Http\Controllers\ProfileController@followUser')->name('user.follow');
    Route::post('profile/{user}/unfollow', 'App\Http\Controllers\ProfileController@unFollowUser')->name('user.unfollow');
    Route::resource('comment', 'App\Http\Controllers\PostCommentsController');
    Route::resource('comment/reply', 'App\Http\Controllers\CommentRepliesController');
    Route::post('/post/{post}/like', 'App\Http\Controllers\LikesController@like')->name('post.like');
    Route::post('/post/{post}/unlike', 'App\Http\Controllers\LikesController@unlike')->name('post.unlike');

});
//Route::resource('/post', 'PostsController');
//Route::resource('/user', 'UserProfileController');


Route::get('/','App\Http\Controllers\ProfileController@posts')->name('home');
Route::get('/post/{post}','App\Http\Controllers\PostsController@show')->name('post.show');

//Route::get('/user/{user}','App\Http\Controllers\UserProfileController@show')->name('user.show');

Route::get('/discover/posts', 'App\Http\Controllers\DiscoverController@posts')->name('discover.posts');
Route::get('/discover/users', 'App\Http\Controllers\DiscoverController@users')->name('discover.users');

Route::get('/user/{user}/followings', 'App\Http\Controllers\ProfileController@followings')->name('followings');
Route::get('/user/{user}/followers', 'App\Http\Controllers\ProfileController@followers')->name('followers');

Route::get('/search', 'App\Http\Controllers\SearchController@index')->name('search');
//Route::get('/check', 'App\Http\Controllers\PostsController@check');

Route::get('/{user}','App\Http\Controllers\UserProfileController@show')->name('user.show');
