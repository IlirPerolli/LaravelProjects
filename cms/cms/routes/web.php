<?php

use App\Country;
use App\Role;
use App\Photo;
use App\Tag;
use App\Video;
use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;
use Carbon\Carbon;
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

//Route::get('/about', function () {
//    return "Hi about page";
//});
//
//Route::get('/contact', function () {
//    return "Hi I am contact";
//});
//
//Route::get('/post/{id}/{name}', function($id,$name){
//    return "This is post number " . $id. " ".$name;
//});
//
//Route::get("/admin/posts/example", array('as' => 'admin.home', function(){
//  $url = route('admin.home');
//  return "Url: ". $url;
//}));
//
//Marrja e funksionit index ne postscontroller
//Route::get('/post/{id}','PostsController@index');
//Me ane te php artisan route:list ne kete menyre na jep qfare duhet te fshijme
//Route::resource('posts', 'PostsController');
//Route::get('/contact','PostsController@contact');
//Route::get('post/{id}/{name}', 'PostsController@show_post');

//Database raw SQL Queries
//Insertimi
//Route::get('/insert', function(){
//   DB::insert('insert into posts (title, content) values(?, ?)', ['PHP with laravel', 'Laravel is the best thing that has happended to php']);
//});

//Selektimi
//Route::get('/read', function(){
//   $results = DB::select('SELECT * from posts where id=?', [1]);
//   //return $results;
//   foreach ($results as $result){
//       return $result->title;
//   }
//});
//Updatimi
//Route::get('/update', function(){
//    $updated = DB::update('update posts set title="Updated title" where id =? ', [1]);
//    return $updated;
//});
//Fshirja
//Route::get('/delete', function(){
//    $deleted = DB::delete('delete from posts where id=?', [1]);
//    return $deleted;
//});


/*
|--------------------------------------------------------------------------
| Eloquent
|--------------------------------------------------------------------------
|*/
//Route::get('/read',function(){
//    //$posts = App\Post; E deklaruam me larte use App\Post
//
//    $posts = Post::all();
//    foreach ($posts as $post){
//        return $post->title;
//        //echo $post->title;
//    }
//
//    //Kerkimi i postimit me id nr 2
//    $post = Post::find(2);
//    return $post->title;
//});

//    Route::get('/findwhere', function(){
//       $posts = Post::where('id',2)->orderBy('id','desc')->take(1)->get();
//        return $posts;
//    });

//Route::get('/findmore', function(){
//    $posts = Post::findOrFail(2);//Nese nuk e gjen atehere paraqitet 404
//    return $posts;
//
//    $posts = Post::where('id', '<',50)->firstOrFail();
//    return $posts;
//});
//Insertimi permes eloquent
//Route::get('/basicinsert', function(){
//    $post = new Post;
//    $post->title = 'new Eloquent title insert';
//    $post->content = 'WOW eloquent is really cool, look at this content';
//    $post->save();
//});
//Updejtimi kur si fillim e gjejme postimin dhe pastaj e updejtojme
//Route::get('/basicinsert2', function(){
//    $post = Post::find(2);
//    $post->title = 'new Eloquent title insert 2';
//    $post->content = 'WOW eloquent is really cool, look at this content 2';
//    $post->save();
//});
//Kete metode e perdorim kur deshirojme te insertojme nga forma por te mos harrojme te shkruajme variablen $fillable ne klasen Post.
//Route::get('/create',function(){
//   Post::create(['title'=>'The create Method', 'content'=>'Wow Im learning a lot with php']);
//});
//Updejtimi por me e mire eshte ajo larte kur e gjejme me id dhe pastaj e updejtojme
//Route::get('/update', function(){
//    Post::where('id',2)->where('is_admin',0)->update(['title'=>'New PHP title', 'content'=>'I love my instructor']);
//});
//Fshirja nga databaza
//Route::get('/delete', function(){
//   $post = Post::find(2);
//   $post->delete();
//});

//Route::get('/delete2', function(){
//    Post::destroy(3);
   // Post::destroy([4,5]);
   // Post::where('is_admin',0)->delete();
//});
//Fshin nje rekord ne databaze por nuk e fshin tamon veq ja inserton tek deleted_at daten edhe nuk paraqitet me metoden Post::find()
//Route::get('/softdelete', function(){
//
//    Post::find(4)->delete();
//
//});

//Route::get('/readsoftdelete',function(){
//    $post = Post::find(4);
//    return $post;
//    $post = Post::withTrashed()->where('id',4)->get();
//    $post = Post::onlyTrashed()->where('id',4)->get();
//    return $post;
//});

//Route::get('/restore', function(){
//    Post::withTrashed()->where('is_admin',0)->restore();
//
//});

//Route::get('/forcedelete', function (){
//    Post::withTrashed()->where('is_admin',0)->forceDelete();
//    Post::onlyTrashed()->where('is_admin',0)->forceDelete();
//});

/*
|--------------------------------------------------------------------------
| Eloquent Relationships
|--------------------------------------------------------------------------
|*/
//Has one (One to one relationship) e kemi deklaruar ne Modelin user.php
//Route::get('/user/{id}/post',function($id){
//    return User::find($id)->post;
//    return User::find($id)->post->title;
//});
//
////Inverse Relation ku e deklarojme funksionin user tek Post.php
//Route::get('/post/{id}/user', function($id){
//    return Post::find($id)->user->name;
//});
//One to many relationship ku e deklarojme funksionin posts ne user
//Route::get('/posts', function(){
//    $user = User::find(1);
//    foreach ($user->posts as $post){
//    echo $post->title;
//    }
//});

//Many to many relationship (fillimisht duhet te krijojme tabelen role_user
//Route::get('/user/{id}/role',function($id){
//  $user= User::find($id);
//  foreach ($user->roles as $role){
//      echo $role->name;
//  }
//ose
//    $user= User::find($id)->roles()->orderBy('id','desc')->get();
//    return $user;
//});

//Accessing the intermediate table (pivot table)
//Dmth qasja e tabeles role_user
//Route::get('/user/pivot', function(){
//   $user = User::find(1);
//    foreach ($user->roles as $role){
//       return $role->pivot->created_at;
//    }
//});

//Marrja e userit nga roli i tij
//Route::get('/role/{id}/user', function($id){
//   $user =  Role::find($id)->users;
//   foreach ($user as $users){
//       echo $users->name;
//   }
//});

//Many through i bjen qe p.sh e kemi nje tabele vetem me emrat e shteteve dhe deshirojme qe nga ato shtete te gjejme komentet
//Route::get('/user/country',function(){
//    $country = Country::find(1);
//    foreach ($country->posts as $post){
//        return $post->title;
//    }
//});
//
//Route::get('/country/{id}/posts',function($id){
//   $country = Country::find($id);
//   foreach ($country->posts as $post){
//       echo $post->title;
//   }
//});

//Polymorphic Relations (perdoret kur kemi p.sh me nje tabele foto (por foto edhe te userave edhe te postimeve perdorim keto relacione))
//Ne kete rast kemi perdorur nga tabela photo ti marrim fotot e userit.
//Route::get('/user/{id}/photos', function($id){
//   $user = User::find($id);
//   foreach ($user->photos as $photo){
//       return $photo;
//   }
//});
//
//Ne kete rast kemi perdorur nga tabela photo ti marrim fotot e userit.
//Route::get('/post/{id}/photos', function($id){
//    $post = Post::find($id);
//    foreach ($post->photos as $photo){
//        return $photo;
//    }
//});
//Ne kete rast kemi perdorur nga tabela photo ti marrim infot e userit ose postimit.
//Route::get('/photo/{id}/post', function($id){
//    $photo = Photo::findOrFail($id);
//    return $photo->imageable;
//});

//Polymorphic Many to Many
//Perdoret njesoj si ajo me larte kur me nje tabele i ruajme tagat edhe te videos edhe te postimeve vetem se kjo eshte shume me shume pra ne tabelen taggable ruhet id e postimit dhe id e tagut
//Ne kete rast kemi kur deshirojme ta gjejme tagun e postimit
//Route::get('/post/tag', function(){
//    $post = Post::find(1);
//    foreach ($post->tags as $tag){
//        echo $tag->name;
//    }
//});
////Ne kete rast kemi kur deshirojme ta gjejme tagun e videos
//Route::get('/video/tag', function(){
//    $post = Video::find(1);
//    foreach ($post->tags as $tag){
//        echo $tag->name;
//    }
//});

//Ne kete rast kemi kur deshirojme ta gjejme postin nga tagu
//Route::get('/tag/post', function(){
//    $tag = Tag::find(2);
//    foreach ($tag->posts as $post){
//        echo $post->title;
//    }
//});
////Ne kete rast kemi kur deshirojme ta gjejme videon nga tagu
//Route::get('/tag/video', function(){
//    $tag = Tag::find(1);
//    foreach ($tag->videos as $post){
//        echo $post->name;
//    }
//});

/*
|--------------------------------------------------------------------------
| Crud Application
|--------------------------------------------------------------------------
|*/

Route::group(['middleware'=>'web'], function(){
    Route::resource('/posts', 'PostsController');

    Route::get('/dates', function(){
        $date = new DateTime('+1 week');
        echo $date->format('m-d-Y');
        echo '<br>';
        echo Carbon::now()->addDays(10)->diffForHumans();
        echo '<br>';
        echo Carbon::now()->subMonth(4)->diffForHumans();
        echo '<br>';
        echo Carbon::now()->yesterday()->diffForHumans();
    });

    Route::get('/getname', function(){
       $user = User::find(1);
       echo $user->name;
    });

    Route::get('/setname', function(){
        $user = User::find(1);
        $user->name = 'william';
        $user->save();
    });

});
