<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class UserChangePhotoController extends Controller
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
        return view('user.change_photo', compact('user', 'followers', 'followings', 'user_posts'));
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
        $user = auth()->user();
        $input= $request->all();
        if($file = $request->file('photo_id')){
            if ($user->photo_id !=1){
                unlink(public_path().$user->photo->photo);
            }

                $request->validate(['photo_id'=>'required|mimes:jpeg,png,jpg,svg|max:2048']);
                $name = time().$file->getClientOriginalName();
                $file->move('images', $name);
                $photo = Photo::create(['photo'=>$name]);
                $input['photo_id'] = $photo->id;
                $user->update($input);
                session()->flash('updated_photo', 'The profile picture has been updated');
                return back();


        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

                $user = auth()->user();
        if ($user->photo_id == 1){
            abort(403, 'Unauthorized action.');
        }
        else{
            unlink(public_path().$user->photo->photo);
            $user->update(['photo_id'=>1]);
            session()->flash('deleted_photo', 'The profile picture has been deleted');
            return back();
        }


    }
}
