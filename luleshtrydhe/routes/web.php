<?php

use App\Category;
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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/post/{id}', 'HomeController@post')->name('home.post');
//Route::get('/posts', 'AdminPostsController@posts')->name('home.posts');
Route::get('/posts/category/{category}', 'HomeController@categories')->name('home.posts.category');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

//Kete 'middleware'=>'auth' e shtova vet per shkak te sigurise kur tentojme ti qasemi perdoruesve
Route::middleware('auth')->group(function(){
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories','AdminCategoriesController');
    Route::resource('admin/media', 'AdminMediasController');
    Route::resource('admin/comments', 'PostCommentsController');
    Route::resource('admin/comments/replies', 'CommentRepliesController');
    Route::get('/admin/{user}/profile', 'AdminProfileController@index')->name('user.profile');
    Route::patch('/admin/{user}/profile', 'AdminProfileController@update');

});
Route::middleware('auth')->group(function() {
   Route::post('comment/reply', 'CommentRepliesController@createReply');

});


Route::middleware('auth', 'admin')->group(function(){

    Route::resource('admin/users', 'AdminUsersController');


});



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');



