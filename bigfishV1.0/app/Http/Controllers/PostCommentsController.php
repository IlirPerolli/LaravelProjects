<?php

namespace App\Http\Controllers;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Comment;
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
        //
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
        $request->validate(['body'=>'required|max:255|min:2']);
        $user = Auth::user();
        $data = [
            'user_id'=>$user->id,
            'post_id'=>$request->post_id,
            'body'=>$request->body
        ];
        Comment::create($data);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $comment = Comment::findBySlugOrFail($slug);
        if (auth()->user()->id != $comment->user->id){
            abort(403, 'Unauthorized action.');
        }
       return view('comments.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if (auth()->user()->id != $comment->user->id){
            abort(403, 'Unauthorized action.');
        }
        $comment->body = $request->body;
        if($comment->isDirty('body')){

                $slug = SlugService::createSlug(Comment::class, 'slug', $comment->body);
            session()->flash('comment_updated', 'Comment has been updated');
            $comment->save();
            return redirect()->route('comment.edit',$slug);
        }
        else{
            session()->flash('nothing_updated', 'Nothing has been updated');

        }
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (auth()->user()->id != $comment->user_id && auth()->user()->id != $comment->post->user->id){
            abort(403, 'Unauthorized action.');
        }
//        if (auth()->user()->id != $comment->post->user->id){
//            abort(403, 'Unauthorized action.');
//        }

        $comment->delete();
        session()->flash('deleted_comment',"Comment has been deleted");
        return back();
    }
}
