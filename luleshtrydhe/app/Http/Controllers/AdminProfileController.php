<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.profile.index', compact('user', 'roles'));
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


        $user = User::findOrFail($id);
        if (($user->id != auth()->user()->id) && !auth()->user()->isAdmin() ){
            abort(403, 'Unauthorized action.');
        }
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }
        if (!auth()->user()->isAdmin()){
            if(trim($request->password) == ''){
                $input = $request->except('role_id', 'is_active','password');
            }
           else{
               $input = $request->except('role_id', 'is_active');
               $input['password'] = bcrypt($request->password);
           }
        }
        else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;

        }

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
        $user = User::findOrFail($id);
        if (($user->id != auth()->user()->id) && !auth()->user()->isAdmin() ){
            abort(403, 'Unauthorized action.');
        }
        if (($user->id != auth()->user()->id) && !auth()->user()->isAdmin() ){
            abort(403, 'Unauthorized action.');
        }
        if ($user->photo->id != 1) {
            //Kete public path e bejme per ta gjetur filen
            unlink(public_path() . $user->photo->file);
        }
        $user->delete();
        session()->flash('deleted_user', 'The user has been deleted');
        return redirect('/admin/users');
    }
}
