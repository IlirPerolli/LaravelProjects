<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        if (auth()->user()->isAdmin()) {
            $postsCount = Post::count();
            $categoriesCount = Category::count();
            $commentsCount = Comment::count();
        }
        else{
            $postsCount = auth()->user()->posts()->count();
            $categoriesCount = Category::count();
            $commentsCount = auth()->user()->comments()->count();
        }


        return view('admin.index', compact('postsCount', 'categoriesCount', 'commentsCount'));
    }
}
