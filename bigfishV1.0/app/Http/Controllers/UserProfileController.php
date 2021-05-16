<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserEditRequest;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::findBySlugOrFail($slug);
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $user_posts = $user->posts->count();
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
        return view('user.show', compact('user','posts', 'followers', 'followings','user_posts' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = User::findBySlugOrFail($slug);
        if (auth()->user()->id != $user->id){
            abort(403, 'Unauthorized action.');
        }
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $user_posts = $user->posts->count();
        return view('user.edit', compact('user','followers', 'followings', 'user_posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        if (auth()->user()->id != $user->id){
            abort(403, 'Unauthorized action.');
        }

            $input = $request->all();
        $user->update($input);
        session()->flash('updated_user', 'The profile has been updated');
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
        //
    }
}
