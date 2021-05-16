<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $postsCount = Post::count();
        $categoriesCount = Category::count();
        $commentsCount = Comment::count();

        return view('admin.index', compact('postsCount', 'categoriesCount', 'commentsCount'));
    }
}
