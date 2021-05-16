<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->isAdmin()){
            $comments = Comment::paginate(5);
        }
        else{
            $comments = auth()->user()->comments()->paginate(5);
        }
       return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = [
            'user_id'=>$user->id,
            'post_id'=>$request->post_id,
            'author'=>$user->name,
            'email'=>$user->email,
            'body'=>$request->body,

        ];
        Comment::create($data);
        session()->flash('comment_message', 'Your message has been submitted and is waiting moderation');
        return back();
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        if (($post->user_id != auth()->user()->id) && !auth()->user()->isAdmin() ){
            abort(403, 'Unauthorized action.');
        }
        $comments = $post->comments;
        return view('admin.comments.show', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        if (($comment->user_id != auth()->user()->id) && !auth()->user()->isAdmin() ){
            abort(403, 'Unauthorized action.');
        }
        //To be done tomorrow
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        if (($comment->user_id != auth()->user()->id) && !auth()->user()->isAdmin() ){
            abort(403, 'Unauthorized action.');
        }
        Comment::findOrFail($id)->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (($comment->user_id != auth()->user()->id) && !auth()->user()->isAdmin() ){
            abort(403, 'Unauthorized action.');
        }
        Comment::findOrFail($id)->delete();
        return back();
    }
}
