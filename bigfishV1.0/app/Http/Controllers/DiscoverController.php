<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }
    public function posts(){
        if(auth()->check()){
            // $users = auth()->user()->followings;
//
//                $users = auth()->user()->followings()->paginate(2);
            $users = auth()->user()->followings()->pluck('leader_id');
            $user = auth()->user()->id;
            $users->push($user);

            $posts = Post::whereNotIn('user_id', $users)->orderBy('created_at', 'DESC')->paginate(20);

            return view('discover.posts', compact('posts'));
        }
        else{
            $posts = Post::orderBy('created_at', 'desc')->paginate(20);
            return view('discover.posts', compact('posts'));
        }
    }
    public function users(){
        if(auth()->check()){

            $users = auth()->user()->followings()->pluck('leader_id');
            $user = auth()->user()->id;
            $users->push($user);

            $users = User::whereNotIn('id', $users)->orderBy('name', 'ASC')->paginate(20);

            return view('discover.users', compact('users'));
        }
        else{
            $users = User::orderBy('name', 'ASC')->paginate(20);
            return view('discover.users', compact('users'));
        }
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
    public function edit($id)
    {
        //
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
        //
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
