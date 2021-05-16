<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function followUser(User $user)
    {

        if(!$user) {

            session()->flash('user_error','User does not exist.' );
            return back();
        }
        if(auth()->user()->id == $user->id){
            session()->flash('user_error','Cannot follow yourself.' );
            return back();
        }

        $user->followers()->attach(auth()->user()->id);
        session()->flash('success_follow','Successfully followed the user.' );
        return back();
    }
    public function unFollowUser(User $user)
    {

        if(!$user) {
            session()->flash('user_error','User does not exist.' );
            return back();

        }
        if(auth()->user()->id == $user->id){
            session()->flash('user_error','Cannot unfollow yourself.' );
            return back();
        }

        $user->followers()->detach(auth()->user()->id);
        session()->flash('success_unfollow','Successfully unfollowed the user' );
        return back();
    }
    public function posts(){
        if(auth()->check()){
            // $users = auth()->user()->followings;
//
//                $users = auth()->user()->followings()->paginate(2);
            $users = auth()->user()->followings()->pluck('leader_id');
            $posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->paginate(20);

            return view('index', compact('posts'));
        }
        else{
            return view('index');
        }
    }
//    public function users(){
//        if(auth()->check()){
//
//            $users = auth()->user()->followings()->pluck('leader_id');
//            $posts = User::whereIn('id', $users)->orderBy('name', 'ASC')->paginate(20);
//
//            return view('discover.users', compact('posts'));
//        }
//        else{
//            return view('index');
//        }
//    }
    public function followings($slug){
        $user = User::findBySlugOrFail($slug);
        $followings = $user->followings()->pluck('leader_id');
        $followings = User::whereIn('id', $followings)->orderBy('name', 'ASC')->paginate(20);
        return view('user.followings',compact('followings', 'user'));
    }
    public function followers($slug){
        $user = User::findBySlugOrFail($slug);
        $followers = $user->followers()->pluck('follower_id');
        $followers = User::whereIn('id', $followers)->orderBy('name', 'ASC')->paginate(20);
        return view('user.followers',compact('followers', 'user'));
    }
}
