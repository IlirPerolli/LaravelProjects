<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //

    public function index(){

      //Per ti shfaqur vetem postet e tua
        //  $posts = auth()->user()->posts;
        //Gjithashtu e bejme komanden php artisan vendor:publish
        $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts.index', ['posts'=>$posts]);
    }

    public function show(Post $post){

        return view('blog-post', ['post' => $post]);
    }
    public function create(){
        return view('admin.posts.create');
    }
    public function store(){
       // $this->authorize('create', Post::class);
    $inputs = request()->validate([
        'title'=>'required|min:8|max:255',
        'post_image'=>'file',
        //'post_image'=>'mimes:jpg,bmp,png',
        'body'=>'required'
    ]);
    if (request('post_image')){
        $inputs['post_image'] = request('post_image')->store('images');
    }
    auth()->user()->posts()->create($inputs);
        Session::flash('post-created-message', 'Post has been created');
    return redirect()->route('post.index');
    }

    public function edit(Post $post){
        $this->authorize('view', $post);//Ne kete menyre e autorizojme perdoruesin se a i perket atij postimi. Se pari krijojme php artisan make:policy PostPolicy --model=Post
//        if (auth()->user()->can('view', $post)){} E njejta si larte
        //Dhe me pas tek metoda update e shkruajme  return $user->id === $post->user_id;
        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function update(Post $post){
        $inputs = request()->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            //'post_image'=>'mimes:jpg,bmp,png',
            'body'=>'required'
        ]);
        if (request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $this->authorize('update', $post);//Ne kete menyre e autorizojme perdoruesin se a i perket atij postimi. Se pari krijojme php artisan make:policy PostPolicy --model=Post
        //Dhe me pas tek metoda update e shkruajme  return $user->id === $post->user_id;
        auth()->user()->posts()->save($post);
        //Menyra tjeter
       // $post->update($inputs);
        Session::flash('post-updated-message', 'Post has been updated');
        return redirect()->route('post.index');
    }
    public function destroy(Post $post){
//Menyra 1
        //        if (auth()->user()->id !== $post->user_id){
//        }
        $this->authorize('delete', $post);

        $post->delete();
        Session::flash('message', 'Post was deleted');
        return back();
    }

}
