<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        return view('front.home',compact('posts','categories'));
    }

    public function post($slug){
        $post = Post::findBySlugOrFail($slug);//Per gjetjen e postit me ane te slugut.
        $categories = Category::all();
        //$post = Post::findBySlugOrIdOrFail($slug);//Per gjetjen e postit me ane te slugut.
        $comments = $post->comments()->whereIsActive(1)->get();

        return view('post',compact('post', 'comments', 'categories'));
    }
    public function categories(Category $category){
        $posts = $category->posts()->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        $category = $category->name;
        return view('post_by_category', compact('posts', 'categories', 'category'));

    }


}
