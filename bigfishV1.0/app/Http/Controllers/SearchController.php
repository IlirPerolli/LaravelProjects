<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->q;

        if ($input!='') {
            $users = User::where(DB::raw('CONCAT( name, " ", surname)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( surname, " ", name)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( name, surname)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( surname, name)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( username)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( slug)'), 'like', '%' . $input . '%')
                ->orWhere('email', 'like', '%' . $input . '%')->get();
            if(count($users)>0){
                return view('search.users', compact('users'));
            }
            else{
                session()->flash('user_not_found', "No Details found. Try to search again !");
                return redirect()->route('search');

            }
        }

        return view('search.users');
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
