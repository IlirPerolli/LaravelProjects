<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->isAdmin()){
            $posts = Post::paginate(5);
        }
       else{
           $posts = auth()->user()->posts()->paginate(5);
       }
        return view ('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id')->all();
        return view ('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $user = Auth::user();
        $input = $request->all();
    if ($file = $request->file('photo_id')){
       $name = time().$file->getClientOriginalName();
       $file->move('images', $name);
       $photo = Photo::create(['file'=>$name]);
       $input['photo_id']=$photo->id;
    }
    $input['user_id']=$user->id;

    $user->posts()->create($input);
    session()->flash('added_post', 'Post created successfully');
        return redirect()->route('posts.index');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (($post->user_id != auth()->user()->id) && !auth()->user()->isAdmin() ){
            abort(403, 'Unauthorized action.');
        }
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsCreateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        if (($post->user_id != auth()->user()->id) && !auth()->user()->isAdmin() ){
            abort(403, 'Unauthorized action.');
        }
        $input = $request->all();
        if ($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;
        }
        Auth::user()->posts()->whereId($id)->first()->update($input);

        session()->flash('updated_post', 'The post has been updated');
        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (($post->user_id != auth()->user()->id) && !auth()->user()->isAdmin() ){
            abort(403, 'Unauthorized action.');
        }
        $post = Post::find($id);
        if ($post->photo){
            unlink(public_path().$post->photo->file);
        }

        $post->delete();
        session()->flash('deleted_post', 'The post has been deleted');
        return redirect()->route('posts.index');
    }

}
