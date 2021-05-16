<?php

namespace App\Http\Controllers;

use App\Models\CommentReply;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
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
            'comment_id'=>$request->comment_id,
            'body'=>$request->body

        ];
        CommentReply::create($data);
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
        $reply = CommentReply::findBySlugOrFail($slug);
        if (auth()->user()->id != $reply->user->id){
            abort(403, 'Unauthorized action.');
        }
        return view('commentReplies.edit',compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentReply $reply)
    {
        if (auth()->user()->id != $reply->user->id){
            abort(403, 'Unauthorized action.');
        }
        $reply->body = $request->body;
        if($reply->isDirty('body')){

            $slug = SlugService::createSlug(CommentReply::class, 'slug', $reply->body);
            session()->flash('reply_updated', 'Reply has been updated');
            $reply->save();
            return redirect()->route('reply.edit',$slug);
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
    public function destroy(CommentReply $reply)
    {
        if (auth()->user()->id != $reply->user_id && auth()->user()->id != $reply->comment->post->user->id && auth()->user()->id != $reply->comment->user_id){
            abort(403, 'Unauthorized action.');
        }
        $reply->delete();
        session()->flash('deleted_reply',"Reply has been deleted");
        return back();
    }
}
