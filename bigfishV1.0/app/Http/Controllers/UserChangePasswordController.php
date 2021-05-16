<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $user_posts = $user->posts->count();
        return view('user.change_password', compact('user', 'followers', 'followings', 'user_posts'));
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
    public function update(Request $request)
    {
        $this->validate($request, [
            'current_password'     => 'required',
            'password'     => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

                $current_password = auth()->user()->password;

                if(Hash::check($request->current_password, $current_password))
                {

                    $password = Hash::make($request->password);
                    auth()->user()->update(['password' => $password]);
                    session()->flash('password_changed', 'Password changed successfully!');
                    return redirect()->route('user.password.edit');
                }
                else
                {
                   session()->flash('invalid-current-password', 'The current password is invalid');
                    return redirect()->route('user.password.edit');
                }
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
